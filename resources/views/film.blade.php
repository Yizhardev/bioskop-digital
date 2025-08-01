@extends('layouts.home')
@section('utama')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Film</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Film</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Agents Section -->


    <section id="agents" class="agents section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            @foreach ($films as $f)
          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="agent-card">
              <div class="agent-image">
                <img src="{{ asset('uploads/'. $f->poster) }}" alt="Agent" class="img-fluid">
                <div class="badge-overlay">
                  <span class="top-seller-badge">Top Seller</span>
                </div>
              </div>
              <div class="agent-info">
                <h4>{{ $f->judul }}</h4>
                <span class="role">{{ $f->tahun }}</span>
                <p class="location"><i class="bi bi-geo-alt"></i>vDowntown Miami</p>
                <div class="specialties">
                  <span class="specialty-tag">{{ $f->genre }}</span>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#loginModal">Beli Tiket</button>
              </div>
            </div>
          </div><!-- End Agent Card -->
           @endforeach

      </div>
                      <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">Silakan Login</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                Anda harus login terlebih dahulu untuk membeli tiket.
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
    </section><!-- /Agents Section -->

  </main>
@endsection
