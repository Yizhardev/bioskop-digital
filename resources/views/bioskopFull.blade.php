@extends('layouts.home')
@section('utama')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Detail Bioskop</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('bioskop') }}">Bioskop</a></li>
                        <li class="current">{{ $bioskop->nama_bioskop }}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Property Details Section -->
        <section id="property-details" class="property-details section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">

                    <!-- Left Column - Main Content -->
                    <div class="col-lg-8">
                        <!-- Property Hero Section -->
                        <div class="property-hero mb-5" data-aos="fade-up" data-aos-delay="200">
                            <div class="hero-image-container">

                                <!-- Main Gallery Slider -->
                                <div class="property-gallery-slider swiper init-swiper">
                                    <script type="application/json" class="swiper-config">
                                    {
                                      "loop": true,
                                      "speed": 600,
                                      "autoplay": {
                                        "delay": 5000
                                      },
                                      "navigation": {
                                        "nextEl": ".swiper-button-next",
                                        "prevEl": ".swiper-button-prev"
                                      },
                                      "thumbs": {
                                        "swiper": ".property-thumbnails-slider"
                                      }
                                    }
                                    </script>

                                    <div class="swiper-wrapper">
                                        <!-- Gambar Utama Bioskop -->
                                        @if ($bioskop->foto)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('uploads/bioskop/' . $bioskop->foto) }}"
                                                    class="img-fluid hero-image"
                                                    alt="{{ $bioskop->nama_bioskop }} - Main Image">
                                                <div class="hero-overlay">
                                                    <div class="property-badge">
                                                        <span class="status-badge for-rent">Tersedia</span>
                                                        <span class="featured-badge">Unggulan</span>
                                                    </div>
                                                    <button class="virtual-tour-btn">
                                                        <i class="bi bi-play-circle"></i>
                                                        Virtual Tour
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Gambar Gallery Bioskop -->
                                        @if ($bioskop->gambarBioskop && $bioskop->gambarBioskop->count() > 0)
                                            @foreach ($bioskop->gambarBioskop as $gambar)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset('uploads/bioskop/' . $gambar->tempat_gambar) }}"
                                                        class="img-fluid hero-image"
                                                        alt="{{ $bioskop->nama_bioskop }} - Gallery Image {{ $loop->iteration }}">
                                                </div>
                                            @endforeach
                                        @endif

                                        <!-- Jika tidak ada gambar sama sekali -->
                                        @if (!$bioskop->foto && (!$bioskop->gambarBioskop || $bioskop->gambarBioskop->count() == 0))
                                            <div class="swiper-slide">
                                                <img src="{{ asset('assets/img/placeholder-cinema.jpg') }}"
                                                    class="img-fluid hero-image" alt="No Image Available">
                                            </div>
                                        @endif

                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>

                                <!-- Thumbnail Gallery -->
                                <div class="thumbnail-gallery mt-3">
                                    <div class="property-thumbnails-slider swiper init-swiper">
                                        <script type="application/json" class="swiper-config">
                                        {
                                          "loop": true,
                                          "spaceBetween": 10,
                                          "slidesPerView": 4,
                                          "freeMode": true,
                                          "watchSlidesProgress": true,
                                          "breakpoints": {
                                            "576": {
                                              "slidesPerView": 5
                                            },
                                            "768": {
                                              "slidesPerView": 6
                                            }
                                          }
                                        }
                                        </script>

                                        <div class="swiper-wrapper">
                                            <!-- Thumbnail Gambar Utama -->
                                            @if ($bioskop->foto)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset('uploads/bioskop/' . $bioskop->foto) }}"
                                                        class="img-fluid thumbnail-img"
                                                        alt="{{ $bioskop->nama_bioskop }} - Main Thumbnail">
                                                </div>
                                            @endif

                                            <!-- Thumbnail Gallery -->
                                            @if ($bioskop->gambarBioskop && $bioskop->gambarBioskop->count() > 0)
                                                @foreach ($bioskop->gambarBioskop as $gambar)
                                                    <div class="swiper-slide">
                                                        <img src="{{ asset('uploads/bioskop/' . $gambar->tempat_gambar) }}"
                                                            class="img-fluid thumbnail-img"
                                                            alt="{{ $bioskop->nama_bioskop }} - Thumbnail {{ $loop->iteration }}">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Property Hero Section -->

                        <!-- Property Information -->
                        <div class="property-info mb-5" data-aos="fade-up" data-aos-delay="300">
                            <div class="property-header">
                                <h1 class="property-title">{{ $bioskop->nama_bioskop }}</h1>
                                <div class="property-meta">
                                    <span class="address"><i class="bi bi-geo-alt"></i> {{ $bioskop->alamat }}, {{ $bioskop->kota }}</span>
                                    <span class="listing-id">ID: #BIO-{{ str_pad($bioskop->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>

                            <div class="pricing-section">
                                <div class="main-price">Rp {{ number_format($bioskop->harga_sewa, 0, ',', '.') }}<span class="period">/Jam</span></div>
                                <div class="price-breakdown">
                                    <span class="deposit">Kapasitas: {{ $bioskop->kapasitas }} orang</span>
                                    <span class="available">Tersedia untuk disewa</span>
                                </div>
                            </div>

                            <div class="quick-stats">
                                <div class="stat-grid">
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="stat-content">
                                            <span class="stat-number">{{ $bioskop->kapasitas }}</span>
                                            <span class="stat-label">Kapasitas</span>
                                        </div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <div class="stat-content">
                                            <span class="stat-number">{{ $bioskop->kota }}</span>
                                            <span class="stat-label">Lokasi</span>
                                        </div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="stat-content">
                                            <span class="stat-number">{{ number_format($bioskop->harga_sewa / 1000, 0) }}K</span>
                                            <span class="stat-label">Harga/Hari</span>
                                        </div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="stat-icon">
                                            <i class="bi bi-images"></i>
                                        </div>
                                        <div class="stat-content">
                                            <span class="stat-number">
                                                {{ ($bioskop->foto ? 1 : 0) + ($bioskop->gambarBioskop ? $bioskop->gambarBioskop->count() : 0) }}
                                            </span>
                                            <span class="stat-label">Foto</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Property Information -->

                        <!-- Deskripsi Bioskop -->
                        @if ($bioskop->deskripsi)
                            <div class="property-details mb-5" data-aos="fade-up" data-aos-delay="400">
                                <h3>Deskripsi Bioskop</h3>
                                <p>{{ $bioskop->deskripsi }}</p>

                                <div class="features-grid mt-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Fasilitas Interior</h5>
                                            <ul class="feature-list">
                                                <li><i class="bi bi-check2"></i> Sistem audio berkualitas tinggi</li>
                                                <li><i class="bi bi-check2"></i> Layar proyektor HD</li>
                                                <li><i class="bi bi-check2"></i> Kursi yang nyaman</li>
                                                <li><i class="bi bi-check2"></i> AC ruangan</li>
                                                <li><i class="bi bi-check2"></i> Pencahayaan yang dapat diatur</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Fasilitas Tambahan</h5>
                                            <ul class="feature-list">
                                                <li><i class="bi bi-check2"></i> Area parkir luas</li>
                                                <li><i class="bi bi-check2"></i> Toilet bersih</li>
                                                <li><i class="bi bi-check2"></i> Ruang tunggu</li>
                                                <li><i class="bi bi-check2"></i> Keamanan 24 jam</li>
                                                <li><i class="bi bi-check2"></i> Akses WiFi</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Location Section -->
                        <div class="location-section mb-5" data-aos="fade-up" data-aos-delay="500">
                            <h3>Lokasi & Area Sekitar</h3>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="map-wrapper">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.5!2d-73.935!3d40.796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQ3JzQ1LjYiTiA3M8KwNTYnMDYuMCJX!5e0!3m2!1sen!2sus!4v1234567890"
                                            width="100%" height="300" style="border:0;" allowfullscreen=""
                                            loading="lazy"></iframe>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="neighborhood-info">
                                        <h5>Tempat Terdekat</h5>
                                        <div class="poi-item">
                                            <i class="bi bi-building"></i>
                                            <div class="poi-content">
                                                <span class="poi-name">Pusat Perbelanjaan</span>
                                                <span class="poi-distance">500m</span>
                                            </div>
                                        </div>
                                        <div class="poi-item">
                                            <i class="bi bi-cup-hot"></i>
                                            <div class="poi-content">
                                                <span class="poi-name">Cafe & Restaurant</span>
                                                <span class="poi-distance">300m</span>
                                            </div>
                                        </div>
                                        <div class="poi-item">
                                            <i class="bi bi-car-front"></i>
                                            <div class="poi-content">
                                                <span class="poi-name">Area Parkir</span>
                                                <span class="poi-distance">Tersedia</span>
                                            </div>
                                        </div>
                                        <div class="poi-item">
                                            <i class="bi bi-bus-front"></i>
                                            <div class="poi-content">
                                                <span class="poi-name">Halte Bus</span>
                                                <span class="poi-distance">200m</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Location Section -->

                    </div><!-- End Left Column -->

                    <!-- Right Sidebar -->
                    <div class="col-lg-4">
                        <div class="sticky-sidebar">

                            <!-- Quick Actions -->
                            <div class="actions-card mb-4" data-aos="fade-up" data-aos-delay="250">
                                <div class="action-buttons">
                                    <button class="btn btn-primary btn-lg w-100 mb-3">
                                        <i class="bi bi-calendar-check"></i>
                                        Jadwalkan Kunjungan
                                    </button>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button class="btn btn-outline-primary w-100">
                                                <i class="bi bi-heart"></i>
                                                Simpan
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-outline-primary w-100">
                                                <i class="bi bi-share"></i>
                                                Bagikan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Quick Actions -->

                            <!-- Contact Form -->
                            <div class="contact-form-card mb-4" data-aos="fade-up" data-aos-delay="350">
                                <h4>Formulir Sewa</h4>
                                <form action="#" method="post" class="php-email-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Nama Lengkap" required="">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Email" required="">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <input type="tel" name="phone" class="form-control"
                                                placeholder="No. Telepon" required="">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <input type="date" name="tanggal_sewa" class="form-control" required="">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select name="durasi" class="form-select" required="">
                                                <option value="">Durasi Sewa...</option>
                                                <option value="1">1 Hari</option>
                                                <option value="2">2 Hari</option>
                                                <option value="3">3 Hari</option>
                                                <option value="7">1 Minggu</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <textarea name="message" class="form-control" rows="4"
                                                placeholder="Catatan tambahan atau pertanyaan..."></textarea>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-send"></i>
                                        Kirim Permintaan Sewa
                                    </button>
                                </form>
                            </div><!-- End Contact Form -->

                            <!-- Rental Calculator -->
                            <div class="calculator-card mb-4" data-aos="fade-up" data-aos-delay="450">
                                <h4>Kalkulator Biaya</h4>
                                <div class="calculator-content">
                                    <div class="cost-item">
                                        <span class="cost-label">Harga per Hari</span>
                                        <span class="cost-value">Rp {{ number_format($bioskop->harga_sewa, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="cost-item">
                                        <span class="cost-label">Estimasi 3 Hari</span>
                                        <span class="cost-value">Rp {{ number_format($bioskop->harga_sewa * 3, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="cost-item">
                                        <span class="cost-label">Estimasi 1 Minggu</span>
                                        <span class="cost-value">Rp {{ number_format($bioskop->harga_sewa * 7, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="cost-item small text-muted">
                                        <span class="cost-label">* Belum termasuk pajak dan biaya administrasi</span>
                                    </div>
                                </div>
                            </div><!-- End Rental Calculator -->

                            <!-- Agent/Contact Info -->
                            <div class="agent-card mb-4" data-aos="fade-up" data-aos-delay="550">
                                <div class="agent-header">
                                    <div class="agent-avatar">
                                        <img src="{{ asset('assets/img/person/person-f-12.webp') }}" class="img-fluid"
                                            alt="Customer Service">
                                        <div class="online-status"></div>
                                    </div>
                                    <div class="agent-info">
                                        <h4>Customer Service</h4>
                                        <p class="agent-role">Layanan Penyewaan Bioskop</p>
                                        <div class="agent-rating">
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                            <span class="rating-text">4.9 (89 ulasan)</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="agent-contact">
                                    <div class="contact-item">
                                        <i class="bi bi-telephone"></i>
                                        <span>+62 812-3456-7890</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="bi bi-envelope"></i>
                                        <span>film@filems.com</span>
                                    </div>
                                </div>

                                <div class="agent-actions mt-3">
                                    <button class="btn btn-success w-100 mb-2">
                                        <i class="bi bi-telephone"></i>
                                        Hubungi Sekarang
                                    </button>
                                    <button class="btn btn-outline-success w-100">
                                        <i class="bi bi-whatsapp"></i>
                                        WhatsApp
                                    </button>
                                </div>
                            </div><!-- End Agent Card -->

                        </div>
                    </div><!-- End Right Sidebar -->

                </div>
            </div>
        </section><!-- /Property Details Section -->

    </main>
@endsection
