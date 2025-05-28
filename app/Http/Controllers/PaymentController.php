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
        return redirect()->route('home')->with('success', 'Payment process initiated. Please wait for confirmation.');
    }

    public function notificationHandler(Request $request)
    {
        $payload = $request->all();
        return response()->json(['status' => 'ok']);
    }
}
