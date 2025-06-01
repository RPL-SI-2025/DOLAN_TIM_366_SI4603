<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function showOrder()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }
    
    
    public function purchaseTicket(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tickets.available')
                ->withErrors($validator)
                ->withInput();
        }

        $quantity = $request->input('quantity');
        $total_amount = $ticket->price * $quantity;

        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'product_id' => $ticket->id,
                'product_type' => Ticket::class,
                'quantity' => $quantity,
                'total_amount' => $total_amount,
                'status' => 'pending',
            ]);

            return redirect()->route('payment.checkout', ['order' => $order->id])
                ->with('success', 'Order created successfully. Please proceed to payment.');
                
        } catch (\Exception $e) {
            return redirect()->route('tickets.available')
                ->with('error', 'Could not create order. Please try again. ' . $e->getMessage());
        }
    }
}
