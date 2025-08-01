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
                <form action="{{ route('admin.filmUp', $film->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" value="{{ $film->judul }}" name="judul" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="sinopsis">Sinopsis</label>
                        <textarea name="sinopsis" class="form-control" rows="4" required>{{ $film->sinopsis }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select name="genre" id="genre" class="form-control">
                            <option value="">-- Pilih Genre --</option>
                            <option value="Action" {{ $film->genre == 'Action' ? 'selected' : '' }}>Action</option>
                            <option value="Adventure" {{ $film->genre == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                            <option value="Drama" {{ $film->genre == 'Drama' ? 'selected' : '' }}>Drama</option>
                            <option value="Comedy" {{ $film->genre == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                            <option value="Horror" {{ $film->genre == 'Horror' ? 'selected' : '' }}>Horror</option>
                            <option value="Romance" {{ $film->genre == 'Romance' ? 'selected' : '' }}>Romance</option>
                            <option value="Sci-Fi" {{ $film->genre == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                            <option value="Thriller" {{ $film->genre == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun terbit</label>
                        <input type="date" name="tahun" value="{{ $film->tahun }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="poster">Foto poster</label>
                        <input type="file" name="poster" class="form-control" onchange="previewPoster()">
                    </div>

                    <div class="mb-3">
                        <img id="poster-preview" src="{{ asset('uploads/' . $film->poster) }}" alt="Preview Gambar"
                            style="max-width: 200px; display: block; border-radius: 8px;">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.film') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
