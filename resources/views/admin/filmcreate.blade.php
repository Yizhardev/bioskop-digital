@extends('layouts.main')

@section('info')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Tambah Film Baru</h1>

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
                <form action="{{ route('admin.filmPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="sinopsis">Sinopsis</label>
                        <textarea name="sinopsis" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select name="genre" id="genre" class="form-control">
                            <option value="">-- Pilih Genre --</option>
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Drama">Drama</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Horror">Horror</option>
                            <option value="Romance">Romance</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                            <option value="Thriller">Thriller</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun terbit</label>
                        <input type="date" name="tahun" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="poster">Foto poster</label>
                        <input type="file" name="poster" class="form-control" onchange="previewPoster()" required>
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
