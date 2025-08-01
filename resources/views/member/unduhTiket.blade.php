<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .tiket {
            border: 2px dashed #333;
            padding: 20px;
            width: 500px;
            margin: auto;
        }
        h2 {
            text-align: center;
            border-bottom: 1px dashed #999;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="tiket">
        <h2>E-Tiket Bioskop</h2>
        <p><strong>Film:</strong> {{ $transaksi->film->judul }}</p>
        <p><strong>Jumlah Tiket:</strong> {{ $transaksi->jumlah_tiket }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($transaksi->status) }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d M Y H:i') }}</p>
        <p><strong>Order ID:</strong> {{ $transaksi->order_id }}</p>
    </div>
</body>
</html>
