@extends('layouts.home')

@section('utama')
    <style>
        .single-post {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
            padding: 2.5rem 2rem;
            margin-bottom: 2rem;
        }

        .post-img img {
            width: 100%;
            max-width: 720px;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.08);
        }

        .post-category {
            font-size: 0.95rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .single-post h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            line-height: 1.2;
        }

        .post-author-img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #eee;
        }

        .post-meta {
            font-size: 0.98rem;
            color: #666;
        }

        .post-content {
            font-size: 1.13rem;
            line-height: 1.8;
            color: #222;
            margin-top: 2rem;
        }

        .post-content p {
            margin-bottom: 1.2em;
        }

        @media (max-width: 768px) {
            .single-post {
                padding: 1.2rem 0.5rem;
            }

            .single-post h1 {
                font-size: 1.3rem;
            }

            .post-img img {
                max-width: 100%;
            }
        }
    </style>
    <section class="single-post-content">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <article class="single-post">

                        <div class="post-img mb-4">
                            <img src="{{ asset('uploads/' . $films->poster) }}"
                                alt="{{ $films->judul }}">
                        </div>


                        <p class="post-category text-primary fw-bold">{{ $films->genre }}</p>
                        <h1>{{ $films->judul }}</h1>


                        <div class="d-flex align-items-center mb-4">
                            <div class="post-meta ms-3">
                                <div class="post-author mb-1 fw-semibold">{{ $films->genre }}</div>
                                <div class="post-date mb-0">
                                    <time
                                        datetime="{{ $films->created_at }}">{{ \Carbon\Carbon::parse($films->created_at)->translatedFormat('d F Y') }}</time>
                                </div>
                            </div>
                        </div>


                        <div class="post-content">
                            {!! nl2br(e($films->sinopsis)) !!}
                        </div>
                    </article>


                    <div class="text-start mt-5 mb-5">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i>
                            Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
