@extends('layouts.main')

@section('info')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Daftar Bioskop</h1>

    <a href="{{ route('admin.create_bioskop') }}" class="btn btn-primary mb-3">+ Tambah Bioskop</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama bioskop</th>
                            <th>Alamat</th>
                            <th>Deskripsi</th>
                            <th>Kota</th>
                            <th>Harga Sewa / 3 jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bioskop as $b)
                        <tr>
                            <td><img src="{{ asset('uploads/bioskop/' . $b->foto) }}" width="100" alt="foto"></td>
                            <td>{{ $b->nama_bioskop }}</td>
                            <td>{{ $b->alamat }}</td>
                            <td>{{ Str::limit($b->deskripsi, 50) }}</td>
                            <td>{{ $b->kota }}</td>
                            <td> Rp. {{ number_format($b->harga_sewa) }}</td>
                            <td>
                                <a href="{{ route('admin.bioskopEdit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.hapusBioskop', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($bioskop->isEmpty())
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
