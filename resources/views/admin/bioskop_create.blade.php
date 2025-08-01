@extends('layouts.main')

@section('info')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Tambah User Baru</h1>

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
                <form action="{{ route('admin.bioskopPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_bioskop">Nama bioskop</label>
                        <input type="text" name="nama_bioskop" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Harga-sewa"> Kapasitas</label>
                        <input type="number" name="kapasitas" id="kapasitas" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Harga-sewa"> Harga Sewa</label>
                        <input type="number" name="harga_sewa" id="harga_sewa" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <select name="kota" id="kota" class="form-control">
                            <option value="">-- Pilih Kota --</option>
                            <option value="Banyuwangi">Banyuwangi</option>
                            <option value="Jember">Jember</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Malang">Malang</option>
                            <option value="Lumajang">Lumajang</option>
                            <option value="Situbondo">Situbondo</option>
                            <option value="Kediri">Kediri</option>
                            <option value="Probolinggo">Probolinggo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" onchange="previewPoster()" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="galeri">Galeri Tambahan (maksimal 5 gambar)</label>
                        <input type="file" name="galeri[]" class="form-control" multiple>
                    </div>
                    <div class="mb-3">
                        <img id="poster-preview" src="#" alt="Preview Gambar"
                            style="max-width: 200px; display: none; border-radius: 8px;">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.bioskop') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
