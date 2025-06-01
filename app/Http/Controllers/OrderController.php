<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Merchandise;
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
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        if (!$ticket->isAvailable($request->quantity)) {
            return redirect()->back()
                ->with('error', 'Sorry, only ' . $ticket->stock . ' tickets are currently available.');
        }

        try {
            $order = null;
            
            $ticket->getConnection()->transaction(function () use ($request, $ticket, &$order) {
                $ticket->refresh();
                
                if (!$ticket->isAvailable($request->quantity)) {
                    throw new \Exception('Insufficient stock available.');
                }

                $total_amount = $ticket->price * $request->quantity;

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'product_id' => $ticket->id,
                    'product_type' => Ticket::class,
                    'quantity' => $request->quantity,
                    'total_amount' => $total_amount,
                    'status' => 'pending',
                ]);

                $ticket->reduceStock($request->quantity);
            });

            if (!$order) {
                return redirect()->back()
                    ->with('error', 'Failed to create order. Please try again.');
            }

            return redirect()->route('payment.checkout', ['order' => $order->id])
                ->with('success', 'Order created successfully. Please proceed to payment.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Could not create order. Please try again. ' . $e->getMessage());
        }
    }

    public function purchaseMerchandise(Request $request, Merchandise $merchandise)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        if (!$merchandise->isAvailable($request->quantity)) {
            return redirect()->back()
                ->with('error', 'Sorry, only ' . $merchandise->stock . ' items are currently available.');
        }

        try {
            $order = null;
            
            $merchandise->getConnection()->transaction(function () use ($request, $merchandise, &$order) {
                $merchandise->refresh();
                
                if (!$merchandise->isAvailable($request->quantity)) {
                    throw new \Exception('Insufficient stock available.');
                }

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'product_id' => $merchandise->id,
                    'product_type' => Merchandise::class,
                    'quantity' => $request->quantity,
                    'total_amount' => $merchandise->price * $request->quantity,
                    'status' => 'pending',
                ]);

                $merchandise->decrement('stock', $request->quantity);
            });

            if (!$order) {
                return redirect()->back()
                    ->with('error', 'Failed to create order. Please try again.');
            }

            return redirect()->route('payment.checkout', ['order' => $order->id])
                ->with('success', 'Order created successfully! Please complete your payment.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function userOrders(Request $request)
    {
        $type = $request->get('type', 'all');
        
        $query = Order::where('user_id', Auth::id())
                     ->with(['product', 'user'])
                     ->whereHas('product')
                     ->orderBy('created_at', 'desc');
        
        if ($type === 'ticket') {
            $query->where('product_type', Ticket::class);
        } elseif ($type === 'merchandise') {
            $query->where('product_type', Merchandise::class);
        }
        
        $orders = $query->paginate(10);
        
        return view('user.orders.index', compact('orders', 'type'));
    }

    public function userOrderDetail($id)
    {
        $order = Order::where('user_id', Auth::id())
                     ->where('id', $id)
                     ->with(['product', 'user'])
                     ->whereHas('product')
                     ->firstOrFail();
        
        return view('user.orders.show', compact('order'));
    }
}
