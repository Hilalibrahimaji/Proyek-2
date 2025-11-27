<!DOCTYPE html>
<html>
<head>
    <title>Midtrans Payment</title>
    <script 
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.clientKey') }}">
    </script>
</head>
<body>
    <h2>Proceed Payment for Order #{{ $order->order_number }}</h2>

    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    window.location.href = "{{ route('checkout.success', $order->id) }}";
                },
                onPending: function(result){
                    alert("Menunggu pembayaran selesai.");
                },
                onError: function(result){
                    alert("Terjadi kesalahan pembayaran.");
                    window.location.href = "{{ route('checkout.cancel', $order->id) }}";
                }
            });
        };
    </script>
</body>
</html>
