<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice</title>

<style>
body {
    font-family: DejaVu Sans, sans-serif;
    color: #1f2937;
    padding: 40px;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}

.brand {
    display: flex;
    align-items: center;
    gap: 10px;
}

.brand img {
    width: 50px;
}

.brand h2 {
    margin: 0;
    font-size: 18px;
}

.invoice-info {
    text-align: right;
}

.invoice-info h1 {
    margin: 0;
    font-size: 28px;
}

.invoice-info p {
    margin: 3px 0;
    font-size: 12px;
    color: #6b7280;
}

/* SECTION */
.section {
    margin-bottom: 25px;
}

.section-title {
    background: #f3f4f6;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: bold;
    border-radius: 6px;
    margin-bottom: 10px;
}

/* GRID */
.grid {
    display: flex;
    justify-content: space-between;
}

.col {
    width: 48%;
}

/* TEXT */
.label {
    font-size: 11px;
    color: #6b7280;
}

.value {
    font-size: 13px;
    margin-bottom: 6px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th {
    background: #f3f4f6;
    font-size: 12px;
    text-align: left;
    padding: 10px;
}

td {
    padding: 10px;
    font-size: 12px;
    border-bottom: 1px solid #eee;
}

/* TOTAL */
.total {
    text-align: right;
    margin-top: 20px;
}

.total h2 {
    margin: 0;
    color: #2563eb;
}

/* STATUS */
.status {
    font-size: 12px;
    margin-top: 5px;
}

.paid {
    color: #16a34a;
    font-weight: bold;
}

.pending {
    color: #f59e0b;
    font-weight: bold;
}

/* FOOTER */
.footer {
    margin-top: 40px;
    font-size: 11px;
    text-align: center;
    color: #9ca3af;
}

</style>
</head>

<body>

<!-- HEADER -->
<div class="header">

    <div class="brand">
        <img src="{{ public_path('images/logo.jpg') }}">
        <div>
            <h2>GoTrip Lampung</h2>
            <small>Travel & Tour</small>
        </div>
    </div>

    <div class="invoice-info">
        <h1>INVOICE</h1>
        <p>#BOOK-{{ $booking->id }}</p>
        <p>{{ date('d M Y') }}</p>
    </div>

</div>

<!-- CUSTOMER + BOOKING -->
<div class="grid">

    <!-- CUSTOMER -->
    <div class="col">
        <div class="section">
            <div class="section-title">CUSTOMER</div>

            <div class="label">Nama</div>
            <div class="value">{{ $booking->nama }}</div>

            <div class="label">Email</div>
            <div class="value">{{ $booking->email }}</div>

            <div class="label">Telepon</div>
            <div class="value">{{ $booking->telepon }}</div>
        </div>
    </div>

    <!-- BOOKING -->
    <div class="col">
        <div class="section">
            <div class="section-title">DETAIL BOOKING</div>

            <div class="label">Tanggal</div>
            <div class="value">{{ $booking->tanggal_booking }}</div>

            <div class="label">Jumlah Orang</div>
            <div class="value">{{ $booking->jumlah_orang }}</div>
        </div>
    </div>

</div>

<!-- TABLE -->
<div class="section">
    <div class="section-title">DETAIL PAKET</div>

    <table>
        <thead>
            <tr>
                <th>Paket</th>
                <th>Destinasi</th>
                <th>Durasi</th>
                <th>Harga</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{ $booking->paketWisata->nama_paket }}</td>

                <td>
                    @if($booking->paketWisata && $booking->paketWisata->destinasi && $booking->paketWisata->destinasi->count())
                        {{ $booking->paketWisata->destinasi->pluck('nama')->join(', ') }}
                    @else
                        -
                    @endif
                </td>

                <td>{{ $booking->paketWisata->durasi_hari }} Hari</td>

                <td>Rp {{ number_format($booking->total_harga,0,',','.') }}</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- TOTAL -->
<div class="total">
    <h2>Rp {{ number_format($booking->total_harga,0,',','.') }}</h2>

    <div class="status">
        Status:
        @if($booking->status == 'paid')
            <span class="paid">PAID</span>
        @else
            <!-- <span class="pending">PENDING</span> -->
             <span class="pending">SUCCESS</span>
        @endif
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    Invoice ini dibuat otomatis oleh sistem GoTrip Lampung
</div>

</body>
</html>