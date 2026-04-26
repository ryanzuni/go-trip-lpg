<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Booking</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
        }

        .title {
            text-align: right;
        }

        .box {
            border:1px solid #ddd;
            padding:15px;
            border-radius:10px;
            margin-bottom: 15px;
        }

        .section-title {
            font-size:14px;
            font-weight:bold;
            margin-bottom:10px;
        }

        .total {
            font-size:16px;
            font-weight:bold;
            color:#2563eb;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <img src="{{ public_path('images/logo.jpg') }}" class="logo">

    <div class="title">
        <h2>INVOICE</h2>
        <p>#BOOK-{{ $booking->id }}</p>
    </div>
</div>

<!-- CUSTOMER -->
<div class="box">
    <div class="section-title">Detail Customer</div>
    <p>Nama: {{ $booking->nama }}</p>
    <p>Email: {{ $booking->email }}</p>
</div>

<!-- PAKET -->
<div class="box">
    <div class="section-title">Detail Paket</div>
    <p>Paket: {{ $booking->paketWisata->nama_paket }}</p>
    <p>Destinasi: {{ $booking->paketWisata->destinasi->nama ?? '-' }}</p>
    <p>Tanggal: {{ $booking->tanggal_booking }}</p>
    <p>Jumlah Orang: {{ $booking->jumlah_orang }}</p>
</div>

<!-- PEMBAYARAN -->
<div class="box">
    <div class="section-title">Pembayaran</div>

    <p class="total">
        Total: Rp {{ number_format($booking->total_harga,0,',','.') }}
    </p>

    <p>
        Status:
        @if($booking->status == 'paid')
            <span class="status-paid">PAID</span>
        @else
            <span class="status-pending">PENDING</span>
        @endif
    </p>
</div>

<!-- FOOTER -->
<p style="text-align:center; font-size:12px;">
    Terima kasih telah melakukan booking di GoTrip Lampung 🙏
</p>

</body>
</html>