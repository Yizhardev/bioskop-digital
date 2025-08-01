@extends('layouts.main')

@section('info')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Daftar Film</h1>

    <a href="{{ route('admin.tentangCreate') }}" class="btn btn-primary mb-3">Tentang</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Judul_tentang</th>
                            <th>Isi_tentang</th>
                            <th>Nomor_tentang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tentang as $t)
                        <tr>
                            <td><img src="{{ asset('uploads/tentang/' . $t->image_tentang) }}" width="100" alt="Poster"></td>
                            <td>{{ $t->judul_tentang }}</td>
                            <td>{{ Str::limit($t->isi_tentang, 100) }}</td>
                            <td>{{ $t->nomor_tentang }}</td>
                            <td>

                                <form action="{{ route('admin.tentangHapus', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($tentang->isEmpty())
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
