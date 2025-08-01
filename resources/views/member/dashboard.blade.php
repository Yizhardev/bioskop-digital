@extends('layouts.main')
@section('info')
   <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Produk Film</h1>
    <div class="row">

        @foreach ($films as $f)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow h-100">
                <img src="{{ asset('uploads/'. $f->poster) }}"
                     class="card-img-top"
                     style="height: 250px; object-fit: cover;"
                     alt="Poster Film">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title" style="min-height: 3rem;">
                        {{ $f->judul }}
                    </h5>
                    <p class="card-text flex-grow-1" style="min-height: 4.5rem;">
                        {{ Str::limit($f->sinopsis, 100) }}
                    </p>
                    <a href="{{ route('member.transaksiCreate', $f->id) }}" class="btn btn-primary mt-auto">Beli Tiket</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
@section('scripts')
    <script>
    const dataPembelian = @json($dataChart);
</script>
@endsection
