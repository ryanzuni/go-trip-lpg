<h2>Bayar Sekarang</h2>

<p>Total: Rp {{ number_format($booking->total_harga,0,',','.') }}</p>

<button id="pay-button">Bayar</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = "/booking-success/{{ $booking->id }}";
        },
        onPending: function(result){
            alert("Menunggu pembayaran");
        },
        onError: function(result){
            alert("Pembayaran gagal");
        }
    });
};
</script>