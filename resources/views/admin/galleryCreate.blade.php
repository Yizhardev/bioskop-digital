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
      <form action="{{ route('admin.galleryUp') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" name="gambar_gallery" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.gallery') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection
