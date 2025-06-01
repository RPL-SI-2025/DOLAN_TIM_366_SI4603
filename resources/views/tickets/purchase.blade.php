@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Available Tickets</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($tickets->isEmpty())
        <p>No tickets currently available for purchase.</p>
    @else
        <div class="list-group">
            @foreach($tickets as $ticket)
                <div class="list-group-item list-group-item-action flex-column align-items-start mb-3">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $ticket->ticket_name }}</h5>
                        <small>Price: IDR {{ number_format($ticket->price, 2) }}</small>
                    </div>
                    @if($ticket->destination)
                        <p class="mb-1">Destination: {{ $ticket->destination->name }}</p>
                    @endif
                    @if($ticket->ticket_date)
                        <p class="mb-1">Date: {{ $ticket->ticket_date->format('D, d M Y') }}</p>
                    @endif
                    
                    <form action="{{ route('purchase.ticket', $ticket->id) }}" method="POST" class="mt-2">
                        @csrf
                        <div class="form-group row">
                            <label for="quantity_{{ $ticket->id }}" class="col-sm-2 col-form-label">Quantity:</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control form-control-sm" id="quantity_{{ $ticket->id }}" name="quantity" value="1" min="1">
                            </div>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-primary btn-sm">Buy Ticket</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 