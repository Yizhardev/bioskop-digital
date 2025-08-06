@extends('layouts.main')
@section('info')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Manajemen User</h1>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
      <a href="{{ route('admin.create') }}" class="btn btn-primary btn-sm">Tambah User</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Dibuat</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $d)
            <tr>
              <td>{{ $d->id }}</td>
              <td>{{ $d->name }}</td>
              <td>{{ $d->email }}</td>
              <td>{{ $d->created_at->format('d-m-Y') }}</td>
              <td>{{ $d->role }}</td>
              <td>
                <a href="{{ route('admin.editUser', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.hapus', $d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

