@extends('layouts.main')

@section('info')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Tentang Kami</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.tentangUp') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul Tentang</label>
                        <input type="text" name="judul_tentang" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="sinopsis">Isi tentang</label>
                        <textarea name="isi_tentang" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Nomor Telepon</label>
                        <input type="number" name="nomor_tentang" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="poster">image_tentang 1</label>
                        <input type="file" name="image_tentang" class="form-control" onchange="previewPoster()" required>
                    </div>
                    <div class="form-group">
                        <label for="poster">image_tentang 2</label>
                        <input type="file" name="image1" class="form-control" onchange="previewPoster()" required>
                    </div>

                    <div class="mb-3">
                        <img id="poster-preview" src="#" alt="Preview Gambar"
                            style="max-width: 200px; display: none; border-radius: 8px;">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.film') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

@endsection
