@extends('layouts.main')

@section('info')
    <main class="main container py-5">
        <h2>E-Tiket</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $transaksi->film->judul }}</h5>
                <p><strong>Order ID:</strong> {{ $transaksi->order_id }}</p>
                <p><strong>Jumlah Tiket:</strong> {{ $transaksi->jumlah_tiket }}</p>
                <p><strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($transaksi->status) }}</p>
                <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>
        <div class="text-start mt-3 mb-5">
            <a href="{{ url()->previous() }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('member.unduhTiket', $transaksi->id) }}" class="btn btn-primary ml-2">🎫 Unduh Tiket</a>
        </div>
    </main>
@endsection
