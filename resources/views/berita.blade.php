@extends('layouts.home')
@section('utama')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Blog</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="current">Blog</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Blog Hero Section -->
        <section id="blog-hero" class="blog-hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4">
                    <!-- Main Content Area -->
                    <div class="col-lg-8">
                        <!-- Featured Article -->
                        @php
                            $beritafirst = $allBerita->take(1);
                            $beritaskip = $allBerita->skip(1)->take(2);
                            $half = ceil($beritaskip->count() / 2);
                            $beritaKiri = $beritaskip->take($half);
                            $beritaKanan = $beritaskip->skip($half);
                        @endphp
                        @foreach ($beritafirst as $b)
                            <article class="featured-post position-relative mb-4" data-aos="fade-up">
                                <img src="{{ asset('uploads/berita/' . $b->gambar_berita) }}" class="img-fluid">
                                <div class="post-overlay">
                                    <div class="post-content">
                                        <div class="post-meta">
                                            <span class="category">{{ $b->jenis_berita }}</span>
                                            <span class="date">{{ $b->tahun }}</span>
                                        </div>
                                        <h2 class="post-title">
                                            <a href="{{ route('beritaFull', $b->id) }}">{{ $b->judul_berita }}</a>
                                        </h2>
                                        <p class="post-excerpt">{{ Str::limit($b->isi_berita, '50') }}</p>
                                        <div class="post-author">
                                            <span>by</span>
                                            <a href="#">{{ $b->penulis_berita }}</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach

                        <!-- Secondary Articles -->
                        <div class="row g-4">
                            <div class="col-md-6">
                                <article class="secondary-post" data-aos="fade-up">
                                    @foreach ($beritaKiri as $b)
                                        <div class="post-image">
                                            <img src="{{ asset('uploads/berita/' . $b->gambar_berita) }}" class="img-fluid">
                                        </div>
                                        <div class="post-content">
                                            <div class="post-meta">
                                                <span class="category">{{ $b->jenis_berita }}</span>
                                                <span class="date">{{ $b->tahun }}</span>
                                            </div>
                                            <h3 class="post-title">
                                                <a href="{{ route('beritaFull', $b->id) }}">{{ $b->judul_berita }}</a>
                                            </h3>
                                            <div class="post-author">
                                                <span>by</span>
                                                <a href="#">{{ $b->penulis_berita }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </article>
                            </div>
                            <div class="col-md-6">
                                <article class="secondary-post" data-aos="fade-up" data-aos-delay="100">
                                    @foreach ($beritaKanan as $b)
                                        <div class="post-image">
                                            <img src="{{ asset('uploads/berita/' . $b->gambar_berita) }}" alt="Post"
                                                class="img-fluid">
                                        </div>
                                        <div class="post-content">
                                            <div class="post-meta">
                                                <span class="category">{{ $b->jenis_berita }}</span>
                                                <span class="date">{{ $b->tahun }}</span>
                                            </div>
                                            <h3 class="post-title">
                                                <a href="{{ route('beritaFull', $b->id) }}">{{ $b->judul_berita }}</a>
                                            </h3>
                                            <div class="post-author">
                                                <span>by</span>
                                                <a href="#">{{ $b->penulis_berita }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </article>
                            </div>
                        </div>
                    </div><!-- End Main Content Area -->

                   <!-- Sidebar with Dynamic Tabs -->
                    <div class="col-lg-4">
                        <div class="news-tabs" data-aos="fade-up" data-aos-delay="200">
                            <!-- Navigation Tabs -->
                            <ul class="nav nav-tabs" role="tablist" id="newsTabList">
                                <!-- Tab Semua Berita -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" type="button" data-category="all" onclick="filterBerita('all')">Semua</button>
                                </li>

                                <!-- Dynamic Tabs from Database -->
                                @foreach($kategori as $kat)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" type="button" data-category="{{ $kat }}" onclick="filterBerita('{{ $kat }}')">{{ ucfirst($kat) }}</button>
                                </li>
                                @endforeach
                            </ul>

                            <!-- Tab Content - Single Container -->
                            <div class="tab-content" id="newsTabContent">
                                <div class="tab-pane fade show active" id="news-content">
                                    <div id="news-container">
                                        @foreach($allBerita as $item)
                                        <article class="tab-post" data-category="{{ $item->jenis_berita }}">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-4">
                                                    <img src="{{ asset('uploads/berita/' . $item->gambar_berita) }}" alt="{{ $item->judul_berita }}"
                                                        class="img-fluid" style="height: 80px; object-fit: cover;">
                                                </div>
                                                <div class="col-8">
                                                    <div class="post-content">
                                                        <span class="category">{{ ucfirst($item->jenis_berita) }}</span>
                                                        <h4 class="post-title">
                                                            <a href="{{ route('beritaFull', $item->id) }}">{{ Str::limit($item->judul_berita, 50) }}</a>
                                                        </h4>
                                                        <div class="post-author">by <a href="#">{{ $item->penulis_berita }}</a></div>
                                                        <div class="post-date">
                                                            <small class="text-muted">{{ $item->created_at->format('d M Y') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Function untuk filter berita
                        window.filterBerita = function(category) {
                            // Reset active tab
                            document.querySelectorAll('.nav-link').forEach(link => {
                                link.classList.remove('active');
                            });

                            // Set active tab
                            document.querySelector(`[data-category="${category}"]`).classList.add('active');

                            // Get all news articles
                            const allArticles = document.querySelectorAll('.tab-post');

                            if (category === 'all') {
                                // Show all articles
                                allArticles.forEach(article => {
                                    article.style.display = 'block';
                                });
                            } else {
                                // Hide all articles first
                                allArticles.forEach(article => {
                                    article.style.display = 'none';
                                });

                                // Show only articles from selected category
                                const categoryArticles = document.querySelectorAll(`[data-category="${category}"]`);
                                categoryArticles.forEach(article => {
                                    article.style.display = 'block';
                                });
                            }

                            // Check if any articles are visible
                            const visibleArticles = document.querySelectorAll('.tab-post[style*="block"], .tab-post:not([style*="none"])');
                            const container = document.getElementById('news-container');

                            // Remove existing "no news" message
                            const existingMessage = container.querySelector('.no-news-message');
                            if (existingMessage) {
                                existingMessage.remove();
                            }

                            // If no articles visible for this category, show message
                            if (category !== 'all' && visibleArticles.length === 0) {
                                const noNewsMessage = document.createElement('div');
                                noNewsMessage.className = 'text-center text-muted py-4 no-news-message';
                                noNewsMessage.innerHTML = '<p>Belum ada berita untuk kategori ini.</p>';
                                container.appendChild(noNewsMessage);
                            }
                        };

                        // Search functionality (optional)
                        const searchInput = document.getElementById('newsSearch');
                        if (searchInput) {
                            searchInput.addEventListener('input', function(e) {
                                const searchTerm = e.target.value.toLowerCase();
                                searchNews(searchTerm);
                            });
                        }

                        // Function to search news
                        function searchNews(searchTerm) {
                            const allArticles = document.querySelectorAll('.tab-post');
                            let visibleCount = 0;

                            // Remove existing "no news" message
                            const container = document.getElementById('news-container');
                            const existingMessage = container.querySelector('.no-news-message');
                            if (existingMessage) {
                                existingMessage.remove();
                            }

                            allArticles.forEach(article => {
                                const title = article.querySelector('.post-title a').textContent.toLowerCase();
                                const category = article.querySelector('.category').textContent.toLowerCase();
                                const author = article.querySelector('.post-author a').textContent.toLowerCase();

                                if (searchTerm === '' ||
                                    title.includes(searchTerm) ||
                                    category.includes(searchTerm) ||
                                    author.includes(searchTerm)) {
                                    article.style.display = 'block';
                                    visibleCount++;
                                } else {
                                    article.style.display = 'none';
                                }
                            });

                            // Show message if no results found
                            if (visibleCount === 0) {
                                const noResultsMessage = document.createElement('div');
                                noResultsMessage.className = 'text-center text-muted py-4 no-news-message';
                                noResultsMessage.innerHTML = '<p>Tidak ada berita yang ditemukan.</p>';
                                container.appendChild(noResultsMessage);
                            }

                            // Reset active tab to "Semua" during search
                            if (searchTerm !== '') {
                                document.querySelectorAll('.nav-link').forEach(link => {
                                    link.classList.remove('active');
                                });
                                document.querySelector('[data-category="all"]').classList.add('active');
                            }
                        }
                    });
                    </script>
                </div>
            </div>
        </section><!-- /Blog Hero Section -->

        <section id="blog-posts" class="blog-posts section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    @foreach ($beritaPaginated as $b)
                    <div class="col-lg-4 col-md-6">
                        <article>
                            <div class="post-img">
                                <img src="{{ asset('uploads/berita/' . $b->gambar_berita) }}" style="width: 100%; height: 300px; object-fit: cover;" class="card-img-top" alt="" class="img-fluid">
                            </div>
                            <p class="post-category">{{ $b->jenis_berita }}</p>
                            <h2 class="title" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 3em;">
                                <a href="{{ route('beritaFull', $b->id) }}" style="text-overflow: ellipsis; overflow: hidden; display: block;">{{ $b->judul_berita }}</a>
                            </h2>
                            <div class="d-flex align-items-center">
                                <div class="post-meta">
                                    <p class="post-author">{{ $b->penulis_berita }}</p>
                                    <p class="post-date">
                                        <time datetime="">{{ $b->created_at->format('d M Y') }}</time>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div><!-- End post list item -->
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Pagination Section -->
        <section id="pagination-2" class="pagination-2 section">
            <div class="container">
                @if($beritaPaginated->hasPages())
                <nav class="d-flex justify-content-center" aria-label="Page navigation">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($beritaPaginated->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link" aria-label="Previous page">
                                    <i class="bi bi-arrow-left"></i>
                                    <span class="d-none d-sm-inline">Previous</span>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $beritaPaginated->previousPageUrl() }}" aria-label="Previous page">
                                    <i class="bi bi-arrow-left"></i>
                                    <span class="d-none d-sm-inline">Previous</span>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($beritaPaginated->getUrlRange(1, $beritaPaginated->lastPage()) as $page => $url)
                            @if ($page == $beritaPaginated->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($beritaPaginated->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $beritaPaginated->nextPageUrl() }}" aria-label="Next page">
                                    <span class="d-none d-sm-inline">Next</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link" aria-label="Next page">
                                    <span class="d-none d-sm-inline">Next</span>
                                    <i class="bi bi-arrow-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
                @endif
            </div>
        </section><!-- /Pagination Section -->

    </main>
@endsection
