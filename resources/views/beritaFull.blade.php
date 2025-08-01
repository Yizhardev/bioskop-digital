@extends('layouts.home')

@section('utama')
<main class="main">
    <section id="berita-detail" class="section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <article>
                        <div class="d-flex justify-content-center align-items-start">
                            <img src="{{ asset('uploads/berita/' . $berita->gambar_berita) }}" alt="{{ $berita->judul_berita }}" class="img-fluid" style="width:100%;max-width:720px;">
                        </div>
                        <div>
                            <span class="text-primary fw-bold">{{ $berita->jenis_berita }}</span>
                        </div>
                        <h1>{{ $berita->judul_berita }}</h1>
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <div class="fw-semibold">{{ $berita->penulis_berita }}</div>
                                <div>
                                    <time datetime="{{ $berita->created_at }}">{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</time>
                                </div>
                            </div>
                        </div>
                        <div>
                            {!! nl2br(e($berita->isi_berita)) !!}
                        </div>
                    </article>
                    <div class="text-start mt-5 mb-5">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
