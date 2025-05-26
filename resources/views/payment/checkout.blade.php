@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Order Summary</h2>
    <p>Order ID: {{ $order->id }}</p>
    <p>Total Amount: {{ number_format($order->total_amount, 2) }}</p>

    <button id="pay-button" class="btn btn-primary">Pay Now</button>
</div>

<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = '{{ route("payment.finish", $order->id) }}?status=success&order_id=' + result.order_id;
            },
            onPending: function(result){
                window.location.href = '{{ route("payment.finish", $order->id) }}?status=pending&order_id=' + result.order_id;
            },
            onError: function(result){
                window.location.href = '{{ route("payment.finish", $order->id) }}?status=error&order_id=' + (result.order_id || '{{ $order->id }}');
            },
            onClose: function(){
                alert('You closed the popup without finishing the payment');
            }
        });
    };
</script>
@endsection 