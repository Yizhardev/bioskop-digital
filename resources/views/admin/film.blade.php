@extends('layouts.main')

@section('info')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Daftar Film</h1>

    <a href="{{ route('admin.filmcreate') }}" class="btn btn-primary mb-3">+ Tambah Film</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th>Judul</th>
                            <th>Sinopsis</th>
                            <th>Genre</th>
                            <th>Tanggal Rilis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($films as $film)
                        <tr>
                            <td><img src="{{ asset('uploads/' . $film->poster) }}" width="100" alt="Poster"></td>
                            <td>{{ $film->judul }}</td>
                            <td>{{ Str::limit($film->sinopsis, 100) }}</td>
                            <td>{{ $film->genre }}</td>
                            <td>{{ $film->tahun }}</td>
                            <td>
                                <a href="{{ route('admin.filmEdit', $film->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.filmhapus', $film->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($films->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data film.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
