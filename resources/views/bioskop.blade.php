@extends('layouts.home')
@section('utama')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Bioskop</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('index') }}">Home</a></li>
            <li class="current">Bioskop</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Bioskop Section -->
    <section id="bioskop" class="properties section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Search Bar -->
        <div class="search-bar mb-5" data-aos="fade-up" data-aos-delay="150">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="search-wrapper">
                <form action="{{ route('bioskop.search') }}" method="GET">
                  <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                      <div class="search-field">
                        <label>Nama Bioskop</label>
                        <input type="text" name="query" class="form-control" placeholder="Cari nama bioskop..." value="{{ request('query') }}">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                      <div class="search-field">
                        <label>Kota</label>
                        <select name="kota" class="form-select">
                          <option value="">Semua Kota</option>
                          @foreach(App\Models\Bioskop::select('kota')->distinct()->orderBy('kota')->pluck('kota') as $kotaItem)
                            <option value="{{ $kotaItem }}" {{ request('kota') == $kotaItem ? 'selected' : '' }}>
                              {{ $kotaItem }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                      <div class="search-field">
                        <label>Status</label>
                        <select name="status" class="form-select">
                          <option value="">Semua Status</option>
                          <option value="buka">Buka</option>
                          <option value="tutup">Tutup</option>
                          <option value="renovasi">Renovasi</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                      <div class="search-field">
                        <label>Fasilitas</label>
                        <div class="bedroom-quick">
                          <button type="button" class="bed-btn" data-facility="any">Semua</button>
                          <button type="button" class="bed-btn" data-facility="3d">3D</button>
                          <button type="button" class="bed-btn" data-facility="imax">IMAX</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                      <div class="search-field">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100 search-btn">
                          <i class="bi bi-search"></i> Cari
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Results Header -->
        <div class="results-header mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="results-info">
                <h5>{{ $bioskop->count() }} Bioskop Ditemukan</h5>
                <p class="text-muted">Menampilkan bioskop di seluruh Indonesia</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="results-controls">
                <div class="d-flex gap-3 align-items-center justify-content-lg-end">
                  <div class="sort-dropdown">
                    <select class="form-select form-select-sm" id="sortBioskop">
                      <option value="nama">Nama: A-Z</option>
                      <option value="nama_desc">Nama: Z-A</option>
                      <option value="kota">Kota: A-Z</option>
                      <option value="terbaru">Terbaru</option>
                    </select>
                  </div>
                  <div class="view-toggle">
                    <button class="view-btn active" data-view="masonry">
                      <i class="bi bi-grid"></i>
                    </button>
                    <button class="view-btn" data-view="rows">
                      <i class="bi bi-view-stacked"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Bioskop Container -->
        <div class="properties-container">

          <!-- Masonry View -->
          <div class="properties-masonry view-masonry active" data-aos="fade-up" data-aos-delay="250">
            <div class="row g-4">

              @foreach($bioskop as $item)
              <div class="col-lg-4 col-md-6">
                <div class="property-item">
                  <a href="{{ route('bioskop.detail', $item->id) }}" class="property-link">
                    <div class="property-image-wrapper">
                      @if($item->foto)
                        <img src="{{ asset('uploads/bioskop/' . $item->foto) }}" alt="{{ $item->nama_bioskop }}" class="img-fluid">
                      @else
                        <img src="{{ asset('assets/img/default-bioskop.jpg') }}" alt="{{ $item->nama_bioskop }}" class="img-fluid">
                      @endif

                      <div class="property-status">
                        <span class="status-badge featured">Bioskop</span>
                        <span class="status-badge sale">Aktif</span>
                      </div>

                      <div class="property-actions">
                        <button class="action-btn favorite-btn" data-toggle="tooltip" title="Tambah ke Favorit">
                          <i class="bi bi-heart"></i>
                        </button>
                        <button class="action-btn share-btn" data-toggle="tooltip" title="Bagikan">
                          <i class="bi bi-share"></i>
                        </button>
                        <button class="action-btn gallery-btn" data-toggle="tooltip" title="Lihat Galeri">
                          <i class="bi bi-images"></i>
                          <span class="gallery-count">1</span>
                        </button>
                      </div>
                    </div>
                  </a>

                  <div class="property-details">
                    <a href="{{ route('bioskop.detail', $item->id) }}" class="property-link">
                      <div class="property-header">
                        <div class="property-price">Rp 1.000.000</div>
                        <div class="property-type">Bioskop</div>
                      </div>
                      <h4 class="property-title">{{ $item->nama_bioskop }}</h4>
                      <p class="property-address">
                        <i class="bi bi-geo-alt"></i>
                        {{ $item->alamat }}, {{ $item->kota }}
                      </p>
                      <div class="property-specs">
                        <div class="spec-item">
                          <i class="bi bi-camera"></i>
                          <span></span>
                        </div>
                        <div class="spec-item">
                          <i class="bi bi-geo-alt-fill"></i>
                          <span>{{ $item->kota }}</span>
                        </div>
                        <div class="spec-item">
                          <i class="bi bi-building"></i>
                          <span>Cinema</span>
                        </div>
                      </div>
                    </a>

                  </div>

                </div>
              </div><!-- End Bioskop Item -->
              @endforeach

            </div>
          </div>

          <!-- Row View -->
          <div class="properties-rows view-rows">
            <div class="row g-4">

              @foreach($bioskop as $item)
              <div class="col-12">
                <div class="property-row-item">
                  <a href="{{ route('bioskop.detail', $item->id) }}" class="property-row-link">
                    <div class="row align-items-center">
                      <div class="col-lg-4">
                        <div class="property-image-wrapper">
                          @if($item->foto)
                            <img src="{{ asset('uploads/bioskop/' . $item->foto) }}" alt="{{ $item->nama_bioskop }}" class="img-fluid">
                          @else
                            <img src="{{ asset('assets/img/default-bioskop.jpg') }}" alt="{{ $item->nama_bioskop }}" class="img-fluid">
                          @endif
                          <div class="property-status">
                            <span class="status-badge featured">Bioskop</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="property-row-content">
                          <div class="row align-items-center">
                            <div class="col-lg-8">
                              <div class="property-info">
                                <div class="property-header">
                                  <h4 class="property-title">{{ $item->nama_bioskop }}</h4>
                                  <div class="property-type-price">
                                    <span class="property-type">Bioskop</span>
                                    <span class="property-price">{{ $item->kota }}</span>
                                  </div>
                                </div>
                                <p class="property-address">
                                  <i class="bi bi-geo-alt"></i>
                                  {{ $item->alamat }}, {{ $item->kota }}
                                </p>
                                <div class="property-specs">
                                  <span><i class="bi bi-camera"></i> 1 Foto</span>
                                  <span><i class="bi bi-geo-alt-fill"></i> {{ $item->kota }}</span>
                                  <span><i class="bi bi-building"></i> Cinema</span>
                                </div>
                                <div class="property-agent">
                                  <img src="{{ asset('assets/img/cinema-icon.png') }}" alt="Cinema" class="agent-avatar">
                                  <span>{{ $item->nama_bioskop }}, Cinema Network</span>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="property-actions">
                                <div class="action-buttons">
                                  <button class="action-btn favorite-btn">
                                    <i class="bi bi-heart"></i> Favorit
                                  </button>
                                  <button class="action-btn contact-btn">
                                    <i class="bi bi-info-circle"></i> Info
                                  </button>
                                  <button class="action-btn gallery-btn">
                                    <i class="bi bi-images"></i> 1 Foto
                                  </button>
                                </div>
                                <span class="btn btn-primary view-details-btn">Lihat Detail</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div><!-- End Bioskop Row Item -->
              @endforeach

            </div>
          </div>

        </div>

        <!-- No Results Message -->
        @if($bioskop->count() == 0)
        <div class="text-center mt-5">
          <div class="alert alert-info">
            <i class="bi bi-info-circle"></i>
            Tidak ada bioskop yang ditemukan. Silakan coba kata kunci pencarian yang lain.
          </div>
        </div>
        @endif

        <!-- Pagination -->
        <nav class="pagination-wrapper mt-5" data-aos="fade-up" data-aos-delay="350">
          <div class="row justify-content-between align-items-center">
            <div class="col-lg-6">
              <div class="pagination-info">
                <p>Menampilkan <strong>1-{{ $bioskop->count() }}</strong> dari <strong>{{ $bioskop->count() }}</strong> bioskop</p>
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="pagination justify-content-lg-end">
                <li class="page-item disabled">
                  <a class="page-link" href="#">
                    <i class="bi bi-chevron-left"></i>
                  </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">
                    <i class="bi bi-chevron-right"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

      </div>

    </section><!-- /Bioskop Section -->

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    const viewBtns = document.querySelectorAll('.view-btn');
    const masonryView = document.querySelector('.view-masonry');
    const rowsView = document.querySelector('.view-rows');

    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.getAttribute('data-view');

            // Update active button
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Switch views
            if (view === 'masonry') {
                masonryView.classList.add('active');
                rowsView.classList.remove('active');
            } else {
                masonryView.classList.remove('active');
                rowsView.classList.add('active');
            }
        });
    });

    // Facility filter buttons
    const facilityBtns = document.querySelectorAll('.bed-btn');
    facilityBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            facilityBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Sort functionality
    const sortSelect = document.getElementById('sortBioskop');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            console.log('Sort by:', this.value);
            // Implementasi sorting bisa ditambahkan di sini
        });
    }
});
</script>

@endsection
