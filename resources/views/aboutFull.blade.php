@extends('layouts.home')

@section('utama')
<main class="main">
    <section id="tentang-detail" class="section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <article>
                        <div class="d-flex justify-content-center align-items-start gap-3 mb-4">
                            <img src="{{ asset('uploads/tentang/' . $tentang->image_tentang) }}" alt="{{ $tentang->judul_tentang }}" class="img-fluid rounded" style="max-width: 300px; height: auto;">
                            <img src="{{ asset('uploads/tentang/' . $tentang->image1) }}" alt="{{ $tentang->judul_tentang }} 2" class="img-fluid rounded" style="max-width: 300px; height: auto;">
                        </div>
                        <div>
                            <span class="text-primary fw-bold">{{ $tentang->nomor_tentang }}</span>
                        </div>
                        <h1>{{ $tentang->judul_tentang }}</h1>
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <div class="fw-semibold"><i class="bi bi-geo-alt-fill"></i> Banyuwangi</div>
                                <div>
                                    <span class="text-muted">Informasi Perusahaan</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            {!! nl2br(e($tentang->isi_tentang)) !!}
                        </div>
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ 'tel:' . $tentang->nomor_tentang }}" class="btn btn-outline-primary" title="Call Now">
                                <i class="bi bi-telephone-fill"></i> Telepon
                            </a>
                            <a href="mailto:filems@filems.com" class="btn btn-outline-secondary" title="Send Email">
                                <i class="bi bi-envelope-fill"></i> Email
                            </a>
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
