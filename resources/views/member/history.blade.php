@extends('layouts.main')

@section('info')
<main class="main container py-5">
    <h2>Riwayat Pembelian Tiket</h2>

    @if ($transaksi->isEmpty())
        <p>Kamu belum pernah membeli tiket.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Film</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>E-Tiket</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $t)
                    <tr>
                        <td>{{ $t->film->judul }}</td>
                        <td>{{ $t->jumlah_tiket }}</td>
                        <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($t->status) }}</td>
                        <td>{{ $t->created_at->format('d M Y H:i') }}</td>
                        <td>
                            @if ($t->status == 'sukses')
                                <a href="{{ route('member.unduhTiket', $t->id) }}" class="btn btn-sm btn-success">Unduh Tiket</a>
                                <span class="text-muted">Dibayar</span>
                            @elseif ($t->status == 'pending')
                                <span class="text-warning">Menunggu Pembayaran</span>
                            @elseif ($t->status == 'gagal')
                                <span class="text-danger">Pembayaran Gagal</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</main>
@endsection
