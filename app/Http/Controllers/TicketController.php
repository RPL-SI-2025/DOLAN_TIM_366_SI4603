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

    public function create()
    {
        $destinations = Destination::all();
        return view('dashboard.tickets.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'destination_id' => 'required|exists:destinations,id',
            'ticket_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.tickets.create')
                ->withErrors($validator)
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
        $destinations = Destination::all();
        return view('dashboard.tickets.edit', compact('ticket', 'destinations'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(), [
            'ticket_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'destination_id' => 'required|exists:destinations,id',
            'ticket_date' => 'nullable|date',
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
        $ticket->delete();

        return redirect()->route('dashboard.tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }

    public function showAvailableTickets()
    {
        $tickets = Ticket::with('destination')->whereNotNull('price')->where('price', '>', 0)->latest()->get(); 
        return view('tickets.purchase', compact('tickets'));
    }

    public function showTicketBookingPage(Destination $destination)
    {
        $ticket = Ticket::where('destination_id', $destination->id)
                        ->whereNotNull('price')
                        ->where('price', '>', 0)
                        ->first();

        if (!$ticket) {
            return redirect()->route('destinations.show', $destination->id)
                             ->with('error', 'Sorry, no tickets are currently available for this destination.');
        }

        return view('booking.ticket_form', compact('destination', 'ticket'));
    }
}
