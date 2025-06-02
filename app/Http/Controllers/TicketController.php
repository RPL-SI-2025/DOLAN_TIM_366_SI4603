<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Destination;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('destination')->latest()->paginate(10);
        return view('dashboard.tickets.index', compact('tickets'));
    }

    public function create(Request $request)
    {
        $destinations = Destination::where('has_ticket', true)
                                  ->whereDoesntHave('ticket')
                                  ->get();
        
        $selectedDestinationId = $request->query('destination_id');
        
        if ($selectedDestinationId) {
            $destination = Destination::find($selectedDestinationId);
            if (!$destination) {
                return redirect()->route('dashboard.tickets.create')
                    ->with('error', 'Destinasi tidak ditemukan.');
            }
            
            if ($destination->hasTicket()) {
                return redirect()->route('dashboard.tickets.index')
                    ->with('error', 'Destinasi "' . $destination->name . '" sudah memiliki tiket.');
            }
            
            if (!$destination->has_ticket) {
                return redirect()->route('dashboard.tickets.create')
                    ->with('error', 'Destinasi "' . $destination->name . '" tidak memerlukan tiket.');
            }
        }
        
        return view('dashboard.tickets.create', compact('destinations', 'selectedDestinationId'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'destination_id' => [
                'required',
                'exists:destinations,id',
                function ($attribute, $value, $fail) {
                    $destination = Destination::find($value);
                    if ($destination && $destination->hasTicket()) {
                        $fail('Destinasi ini sudah memiliki tiket.');
                    }
                    if ($destination && !$destination->has_ticket) {
                        $fail('Destinasi ini tidak memerlukan tiket.');
                    }
                },
            ],
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.tickets.create')
                ->withErrors($validator)
                ->withInput();
        }

        $destination = Destination::find($request->destination_id);
        if ($destination->hasTicket()) {
            return redirect()->route('dashboard.tickets.create')
                ->with('error', 'Destinasi ini sudah memiliki tiket.')
                ->withInput();
        }

        Ticket::create($request->all());

        return redirect()->route('dashboard.tickets.index')
            ->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('destination');
        return view('dashboard.tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $destinations = Destination::where('has_ticket', true)
                                  ->where(function($query) use ($ticket) {
                                      $query->whereDoesntHave('ticket')
                                            ->orWhere('id', $ticket->destination_id);
                                  })
                                  ->get();
        
        return view('dashboard.tickets.edit', compact('ticket', 'destinations'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(), [
            'ticket_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'destination_id' => [
                'required',
                'exists:destinations,id',
                function ($attribute, $value, $fail) use ($ticket) {
                    $destination = Destination::find($value);
                    if ($destination && $destination->hasTicket() && $destination->ticket->id !== $ticket->id) {
                        $fail('Destinasi ini sudah memiliki tiket lain.');
                    }
                    if ($destination && !$destination->has_ticket) {
                        $fail('Destinasi ini tidak memerlukan tiket.');
                    }
                },
            ],
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.tickets.edit', $ticket->id)
                ->withErrors($validator)
                ->withInput();
        }

        $ticket->update($request->all());

        return redirect()->route('dashboard.tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $pendingOrders = $ticket->orders()->where('status', 'pending')->count();
        
        if ($pendingOrders > 0) {
            return redirect()->route('dashboard.tickets.index')
                ->with('error', 'Cannot delete ticket. There are pending orders for this ticket.');
        }

        $ticket->delete();

        return redirect()->route('dashboard.tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }

    public function showAvailableTickets()
    {
        $tickets = Ticket::with('destination')
                        ->whereHas('destination', function($query) {
                            $query->where('has_ticket', true);
                        })
                        ->where('stock', '>', 0)
                        ->whereNotNull('price')
                        ->where('price', '>', 0)
                        ->latest()
                        ->get(); 
        return view('tickets.purchase', compact('tickets'));
    }

    public function showTicketBookingPage(Destination $destination)
    {
        $ticket = $destination->getAvailableTicket();

        if (!$ticket) {
            return redirect()->route('destinations.show', $destination->id)
                             ->with('error', 'Sorry, no tickets are currently available for this destination.');
        }

        // Check if ticket is out of stock
        if ($ticket->stock <= 0) {
            return redirect()->route('destinations.show', $destination->id)
                             ->with('error', 'Maaf, tiket untuk destinasi ini sudah habis. Silakan hubungi kami untuk informasi lebih lanjut.');
        }

        return view('user.destinations.ticket_form', compact('destination', 'ticket'));
    }
}
