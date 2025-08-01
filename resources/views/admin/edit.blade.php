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
      <form action="{{ route('admin.edit', $users->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name">Nama</label>
          <input type="text" name="name" value="{{ $users->name }}" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" value="{{ $users->email }}" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" >
        </div>

        <div class="form-group">
          <label for="password_confirmation">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="form-control" >
        </div>

        <div class="form-group">
          <label for="role">Pilih Role</label>
          <input type="" name="password_confirmation" class="form-control" >
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.user') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection
