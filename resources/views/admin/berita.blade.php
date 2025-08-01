@extends('layouts.main')

@section('info')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Daftar Berita</h1>

    <a href="{{ route('admin.beritaCreate') }}" class="btn btn-primary mb-3">+ Tambah Berita</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Judul berita</th>
                            <th>Isi berita</th>
                            <th>Penulis Berita</th>
                            <th>Jenis berita</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($berita as $b)
                        <tr>
                            <td><img src="{{ asset('uploads/berita/' . $b->gambar_berita) }}" width="100" alt="foto"></td>
                            <td>{{ $b->judul_berita }}</td>
                            <td>{{ Str::limit($b->isi_berita) }}</td>
                            <td>{{ $b->penulis_berita }}</td>
                            <td>{{ $b->jenis_berita }}</td>
                            <td>
                                <a href="{{ route('admin.beritaEdit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.beritaHapus', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
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
