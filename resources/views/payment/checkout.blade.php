<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment | 
    @if($order->product_type === 'App\\Models\\Ticket')
        {{ $order->product->ticket_name }}
    @elseif($order->product_type === 'App\\Models\\Merch')
        {{ $order->product->name }}
    @else
        Product
    @endif
</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-[#F0ECEC] to-white">
<x-navbar />
<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow-xl rounded-lg sm:px-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-purple-800">
                    Order Summary
                </h2>
            </div>
            <div class="space-y-6">
                <div>
                    <p class="text-lg text-gray-700">Order ID: <span class="font-semibold text-indigo-600">{{ $order->id }}</span></p>
                </div>
                <div>
                    <p class="text-lg text-gray-700">Total Amount: <span class="font-semibold text-indigo-600">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
                </div>
                <div class="pt-6">
                    <button id="pay-button" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-lg font-bold text-white bg-gradient-to-r from-purple-500 to-black hover:from-purple-600 hover:to-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-150 ease-in-out">
                        Pay Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Midtrans Snap JS --}}
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
</body>
</html>