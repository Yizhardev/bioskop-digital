@extends('layouts.main')

@section('info')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Daftar Gambar</h1>

    <a href="{{ route('admin.galleryCreate') }}" class="btn btn-primary mb-3">+ gambar</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gallery as $g)
                        <tr>
                            <td><img src="{{ asset('uploads/gallery/' . $g->gambar_gallery) }}" width="100" alt="Poster"></td>
                            <td>

                                <form action="{{ route('admin.galleryHapus', $g->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($gallery->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data gallery</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
