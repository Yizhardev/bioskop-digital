@extends('layouts.home')
@section('utama')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero-film" class="hero-film-section"
            style="background: linear-gradient(135deg, #1a1a2e 60%, #16213e 100%); color: #fff; padding: 80px 0 40px;">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="hero-content text-center" data-aos="zoom-in" data-aos-delay="200">
                            <h1
                                style="font-size: 3rem; font-weight: bold; letter-spacing: 2px; color: #459ae9; text-shadow: 2px 2px 8px rgba(0,0,0,0.3);">
                                FILEMS</h1>
                            <p class="hero-description"
                                style="font-size: 1.2rem; color: #fff; max-width: 700px; margin: 0 auto; text-shadow: 1px 1px 6px rgba(30,42,73,0.2);">
                                FILEMS adalah perusahaan yang bergerak di bidang perfilman dan penyewaan studio bioskop.
                                Kami menghadirkan ruang kreatif bagi para pembuat film, serta menyediakan studio bioskop
                                modern untuk berbagai keperluan penayangan dan produksi. Dengan semangat inovasi dan
                                dedikasi pada kualitas, FILMS menjadi mitra ideal dalam setiap langkah proses kreatif
                                industri sinema.
                            </p>
                        </div>
                        <div class="dual-image-layout mt-5" data-aos="fade-up" data-aos-delay="300">
                            @php
                                $gambar = $gallery->get(0);
                                $gambar1 = $gallery->get(1);
                            @endphp
                            @if ($gambar && $gambar1)
                                <div class="row g-4 align-items-center">
                                    <div class="col-lg-6">
                                        <div class="primary-image-wrap position-relative"
                                            style="border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(233,69,96,0.15);">
                                            <img src="{{ asset('uploads/gallery/' . $gambar->gambar_gallery) }}"
                                                alt="Luxury Property" class="img-fluid"
                                                style="filter: brightness(0.95) contrast(1.1);">
                                            <div class="floating-badge position-absolute top-0 end-0 m-3" data-aos="zoom-in"
                                                data-aos-delay="400"
                                                style="background: #459ae9; color: #fff; padding: 10px 18px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.12);">
                                                <div class="badge-content d-flex align-items-center gap-2">
                                                    <i class="bi bi-award" style="font-size: 1.5rem;"></i>
                                                    <span style="font-weight: 600;">Top Rated Agency</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="secondary-image-wrap"
                                            style="border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(30,42,73,0.15);">
                                            <img src="{{ asset('uploads/gallery/' . $gambar1->gambar_gallery) }}"
                                                alt="Professional Agent" class="img-fluid"
                                                style="filter: brightness(0.95) contrast(1.1);">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="cta-section mt-5" data-aos="fade-up" data-aos-delay="500">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8">
                            <h3 style="color: #459ae9; font-weight: bold; text-shadow: 1px 1px 6px rgba(30,42,73,0.2);">Siap
                                Memilih Film Favoritmu?</h3>
                            <p style="color: #fff; text-shadow: 1px 1px 6px rgba(30,42,73,0.2);">Temukan film terbaru,
                                studio bioskop terbaik, dan pengalaman sinema yang tak terlupakan bersama FILEMS. Mulai
                                petualangan sinema Anda sekarang!</p>
                            <div class="action-buttons d-flex justify-content-center gap-3 mt-3">
                                <a href="{{ route('film') }}" class="btn btn-primary"
                                    style="background: linear-gradient(90deg, #459ae9 60%, #0f3460 100%); border: none; font-weight: 600; padding: 12px 32px; border-radius: 30px; box-shadow: 0 4px 16px rgba(233,69,96,0.15); transition: background 0.3s;">
                                    Jelajahi Film
                                </a>
                                <a href="{{ route('tentangFull', 5) }}" class="btn btn-outline-light"
                                    style="font-weight: 600; padding: 12px 32px; border-radius: 30px; border: 2px solid #459ae9; color: #459ae9; background: transparent; transition: background 0.3s, color 0.3s;">
                                    Tentang Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Home About Section -->
        <section id="home-about" class="home-about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-5">
                    @foreach ($tentang as $t)
                        <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
                            <div class="image-gallery">
                                <div class="primary-image">
                                    <img src="{{ asset('uploads/tentang/' . $t->image_tentang) }}" alt="Modern Property"
                                        class="img-fluid">
                                    <div class="experience-badge">
                                        <div class="badge-content">
                                            <div class="number"><span data-purecounter-start="0" data-purecounter-end="15"
                                                    data-purecounter-duration="1" class="purecounter"></span>+</div>
                                            <div class="text">Years<br>Experience</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="secondary-image">
                                    <img src="{{ asset('uploads/tentang/' . $t->image1) }}" alt="Luxury Interior"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">

                            <div class="content">
                                <div class="section-header">
                                    <span class="section-label">Tentang perusahaan kami</span>
                                    <h2>{{ $t->judul_tentang }}</h2>
                                </div>

                                <p>{{ Str::limit($t->isi_tentang, '50') }}</p>

                                <div class="action-section">
                                    <a href="{{ route('tentangFull', $t->id) }}" class="btn-cta">
                                        <span>Discover Our Story</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                    <div class="contact-info">
                                        <div class="contact-icon">
                                            <i class="bi bi-telephone"></i>
                                        </div>
                                        <div class="contact-details">
                                            <span>Call us today</span>
                                            <strong>{{ $t->nomor_tentang }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </section><!-- /Home About Section -->

        <!-- Featured Properties Section -->
        <section id="featured-properties" class="featured-properties section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Studio Bioskop</h2>
                <p>Kami telah bekerja sama dengan beberapa bioskop yang tersebar di berbagai daerah di Indonesia,
                    terutama di Jawa Timur</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">


                <div class="row">
                    @php $shown = []; @endphp
                    @foreach ($bioskop as $b)
                        @if (!in_array($b->nama_bioskop, $shown))
                            @php $shown[] = $b->nama_bioskop; @endphp

                            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="600">
                                <div class="property-card-horizontal">
                                    <div class="property-image-horizontal">
                                        <img src="{{ asset('uploads/bioskop/' . $b->foto) }}" alt="{{ $b->nama_bioskop }}"
                                            class="img-fluid w-100" style="height: 250px; object-fit: cover;">
                                        <div class="property-badge-horizontal exclusive">Now Showing</div>
                                    </div>
                                    <div class="property-content-horizontal">
                                        <h3><a href="#">{{ $b->nama_bioskop }}</a></h3>
                                        <div class="property-location-horizontal">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>{{ $b->alamat ?? 'Lokasi tidak tersedia' }}</span>
                                        </div>
                                        <div class="property-features">
                                            <span class="feature"><i class="bi bi-clock"></i>
                                                {{ $b->kota }}</span>
                                            <span class="feature"><i class="bi bi-star-fill"></i>
                                                {{ $b->nama_bioskop }}</span>
                                        </div>
                                        <p>{{ Str::limit($b->bioskop, 100) }}</p>

                                        <!-- Button Sewa Sekarang -->
                                        <div class="mt-3">
                                            @if (auth()->check())
                                                <a href="{{ route('index') }}"
                                                    class="btn btn-primary btn-sm px-4 py-2 rounded-pill fw-bold text-white text-decoration-none shadow-sm">
                                                    <i class="bi bi-calendar-check me-2"></i>
                                                    Sewa Sekarang
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-primary btn-sm px-4 py-2 rounded-pill fw-bold text-white text-decoration-none shadow-sm" data-bs-toggle="modal"
                                                    data-bs-target="#loginModal">
                                                    <i class="bi bi-calendar-check me-2"></i>
                                                    Sewa Sekarang
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Modal Login -->
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
                                Anda harus login terlebih dahulu untuk menyewa studio.
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </section><!-- /Featured Properties Section -->

        <!-- Featured Services Section -->
        <!-- Featured Agents Section -->
        <section id="featured-agents" class="featured-agents section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Film yang sedang tayang</h2>
                <p>Berikut adalah film-film yang sedang tayang di bioskop kami. Silakan pilih film yang ingin Anda tonton.
                </p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 justify-content-center">
                    @php $shown = []; @endphp
                    @foreach ($films as $f)
                        @if (!in_array($f->judul, $shown))
                            @php $shown[] = $f->judul; @endphp
                            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                                <div class="featured-agent">
                                    <div class="agent-wrapper">
                                        <div class="agent-photo">
                                            <img src="{{ asset('uploads/' . $f->poster) }}" alt="Featured Agent"
                                                class="img-fluid">
                                            <div class="overlay-info">
                                                <div class="contact-actions">
                                                    <a href="https://wa.me/081338761658" class="contact-btn phone"
                                                        title="Call Now">
                                                        <i class="bi bi-telephone-fill"></i>
                                                    </a>
                                                    <a href="mailto:filems@filems.com" class="contact-btn email"
                                                        title="Send Email">
                                                        <i class="bi bi-envelope-fill"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <span class="achievement-badge">{{ $f->genre }}</span>
                                        </div>
                                        <div class="agent-details">
                                            <h4>{{ $f->judul }}</h4>
                                            <span class="position">{{ $f->tahun }}</span>
                                            <div class="expertise-tags">
                                                <span class="tag">{{ $f->genre }}</span>
                                            </div>
                                            <a href="{{ route('filmFull', $f->id) }}"
                                                class="view-profile">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Featured Agent -->
                        @endif
                    @endforeach

                </div>

                <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
                    <a href="{{ route('film') }}" class="discover-all-agents">
                        <span>Jelajahi semua film</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>

        </section><!-- /Featured Agents Section -->

        <!-- Why Us Section -->
        <!-- Call To Action Section -->
        <!-- Recent Blog Posts Section -->
        <section id="recent-blog-posts" class="recent-blog-posts section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Berita</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                        @php
                            $featuredBerita = $berita->take(2); // 2 pertama
                            $recentBerita = $berita->skip(2); // sisanya
                        @endphp

                        @foreach ($featuredBerita as $b)
                            <article class="featured-post" data-aos="fade-up" data-aos-delay="400">
                                <div class="featured-img">
                                    <img src="{{ asset('uploads/berita/' . $b->gambar_berita) }}" alt=""
                                        class="img-fluid" loading="lazy">
                                    <div class="featured-badge">{{ $b->jenis_berita }}</div>
                                </div>

                                <div class="featured-content">
                                    <div class="post-header">
                                        <a href="#" class="category">{{ $b->jenis_berita }}</a>
                                        <span class="post-date">{{ $b->tahun }}</span>
                                    </div>

                                    <h2 class="post-title">
                                        <a href="{{ route('beritaFull', $b->id) }}">{{ $b->judul_berita }}</a>
                                    </h2>

                                    <p class="post-excerpt">
                                        {{ Str::limit($b->isi_berita, '50') }}
                                    </p>

                                    <div class="post-footer">
                                        <div class="author-info">

                                            <div class="author-details">
                                                <span class="author-name">{{ $b->penulis_berita }}</span>

                                            </div>
                                        </div>
                                        <a href="#" class="read-more">Read More</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div><!-- End featured post -->

                    <div class="col-lg-4">
                        @foreach ($recentBerita as $b)
                            <article class="recent-post" data-aos="fade-up" data-aos-delay="200">
                                <div class="recent-img">
                                    <img src="{{ asset('uploads/berita/' . $b->gambar_berita) }}" alt=""
                                        class="img-fluid" loading="lazy">
                                </div>
                                <div class="recent-content">
                                    <a href="#" class="category">{{ $b->jenis_berita }}</a>
                                    <h3 class="recent-title">
                                        <a href="{{ route('beritaFull', $b->id) }}">{{ $b->judul_berita }}</a>
                                    </h3>
                                    <div class="recent-meta">
                                        <span class="author">{{ $b->penulis_berita }}</span>
                                        <span class="date">{{ $b->tahun }}</span>
                                    </div>
                                </div>
                            </article><!-- End recent post -->
                        @endforeach

                    </div>

                </div>

            </div>

        </section><!-- /Recent Blog Posts Section -->

    </main>
@endsection
