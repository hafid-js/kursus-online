<!DOCTYPE html>
<html>
<head>
    <title>Midtrans Payment</title>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert('Pembayaran berhasil!');
                },
                onPending: function(result){
                    alert('Menunggu pembayaran...');
                },
                onError: function(result){
                    alert('Pembayaran gagal!');
                }
            });
        });
    </script>
</body>
</html>
