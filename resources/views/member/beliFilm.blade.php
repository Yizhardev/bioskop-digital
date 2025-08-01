@extends('layouts.main')

@section('info')
<main class="main container py-5">
    <h2>Beli Tiket: {{ $film->judul }}</h2>

    {{-- Form utama --}}
    <form id="formUtama">
        @csrf
        <div class="mb-3">
            <label>Jumlah Tiket</label>
            <input type="number" id="jumlahTiketInput" name="jumlah_tiket" class="form-control" min="1" required>
        </div>
        <button type="button" id="bukaModal" class="btn btn-primary">Bayar Sekarang</button>
    </form>


</main>

{{-- JavaScript --}}

@endsection
@section('scripts')

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.getElementById('bukaModal').addEventListener('click', function () {
        const jumlah = document.getElementById('jumlahTiketInput').value;

        if (jumlah < 1) {
            alert("Jumlah tiket minimal 1");
            return;
        }

        // Kirim AJAX ke controller Laravel
        fetch("{{ route('member.filmBayar', $film->id) }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ jumlah_tiket: jumlah })
        })
        .then(res => {
            if (!res.ok) {
                return res.text().then(text => { throw new Error(text); });
            }
            return res.json();
        })
        .then(data => {
            // Buka Snap Midtrans
            window.snap.pay(data.snap_token, {
                onSuccess: function(result) {
                    window.location.href = "/member/etiket"; // arahkan ke halaman e-tiket
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                },
                onError: function(result) {
                    alert("Terjadi kesalahan saat pembayaran.");
                },
                onClose: function() {
                    alert("Kamu menutup tanpa menyelesaikan pembayaran.");
                }
            });
        })
        .catch(error => {
            console.error("Gagal:", error);
            alert("Terjadi error saat memulai pembayaran. Lihat console.");
        });
    });
</script>
@endsection
