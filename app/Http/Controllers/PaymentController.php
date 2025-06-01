<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Merchandise;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {

            abort(403, 'Unauthorized action.'); 
        }

        $order->load('product', 'user');

        $transaction_details = [
            'order_id' => $order->id . '-' . time(),
            'gross_amount' => $order->total_amount,
        ];

        $customer_details = [
            'first_name' => $order->user->name,
            'email' => $order->user->email,
        ];
        
        $product_name = '';
        if ($order->product_type === Ticket::class) {
            $product_name = $order->product->ticket_name;
        } elseif ($order->product_type === Merchandise::class) {
            $product_name = $order->product->name;
        }

        $item_details = [
            [
                'id' => $order->product->id,
                'price' => $order->product->price, 
                'quantity' => $order->quantity,
                'name' => $product_name,
            ]
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            'callbacks' => [
                'finish' => route('payment.finish', $order->id),
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('payment.checkout', compact('snapToken', 'order')); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function paymentFinish(Request $request, Order $order)
    {
        $status = $request->query('status');
        
        if ($status === 'success') {
            // Update order status to completed
            $order->update(['status' => 'completed']);
            
            if ($order->product) {
            $order->product->reduceStock($order->quantity);
        }
            
            return redirect()->route('user.orders')->with('success', 'Payment successful! Your order has been completed.');
        } elseif ($status === 'pending') {
            return redirect()->route('home')->with('info', 'Payment is pending. Please wait for confirmation.');
        } else {
            // For error status
            $order->update(['status' => 'cancelled']);
            return redirect()->route('home')->with('error', 'Payment failed. Your order has been cancelled.');
        }
    }

    public function notificationHandler(Request $request)
    {
        $payload = $request->all();
        
        $order_id = $payload['order_id'] ?? null;
        $status_code = $payload['status_code'] ?? null;
        $transaction_status = $payload['transaction_status'] ?? null;
        
        if ($order_id) {
            $actual_order_id = explode('-', $order_id)[0];
            $order = Order::find($actual_order_id);
            
            if ($order) {
                if ($transaction_status == 'capture' || $transaction_status == 'settlement') {
                    // Payment successful
                    $order->update(['status' => 'completed']);
                    if ($order->product) {
                    $order->product->reduceStock($order->quantity);
                    }
                } elseif ($transaction_status == 'pending') {
                    // Payment pending
                    $order->update(['status' => 'pending']);
                } elseif ($transaction_status == 'deny' || $transaction_status == 'expire' || $transaction_status == 'cancel') {
                    // Payment failed/cancelled
                    $order->update(['status' => 'cancelled']);
                }
            }
        }
        
        return response()->json(['status' => 'ok']);
    }
}
