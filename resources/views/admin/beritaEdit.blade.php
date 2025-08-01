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
                <form action="{{ route('admin.beritaEP', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="judul_berita">Judul Berita</label>
                        <input type="text" name="judul_berita" value="{{ $berita->judul_berita }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="isi_berita">Isi berita</label>
                        <textarea name="isi_berita" class="form-control" rows="4" required>{{ $berita->isi_berita }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="Jenis_berita">Jenis berita</label>
                        <select name="jenis_berita" id="genre" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Film">Film</option>
                            <option value="Teknologi">Teknologi</option>
                            <option value="Drama">Drama</option>
                            <option value="Bioskop">Bioskop</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun Berita</label>
                        <input type="date" name="tahun" value='{{ $berita->tahun }}' class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="penulis_berita">Penulis Berita</label>
                        <input type="text" name="penulis_berita" value="{{ $berita->penulis_berita }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="berita">Foto berita</label>
                        <input type="file" name="gambar_berita" class="form-control" onchange="previewPoster()" required>
                    </div>

                    <div class="mb-3">
                        <img id="poster-preview" src="#" alt="Preview Gambar"
                            style="max-width: 200px; display: none; border-radius: 8px;">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.berita') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

@endsection
