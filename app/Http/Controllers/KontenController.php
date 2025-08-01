<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use App\Models\Berita;
use App\Models\Bioskop;
use App\Models\Gallery;
use App\Models\Tentang;
use Illuminate\Http\Request;
use App\Models\GambarBioskop;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KontenController extends Controller
{
    public function film(){
        $films = Film::get();
        return view('admin.film', compact('films'));
    }

    public function filmcreate(){
        return view('admin.filmcreate');
    }

    public function filmPost(Request $request){
        $validated = $request->validate([
            'judul' => 'required|string',
            'sinopsis' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'tahun' => 'required|date',
            'poster' => 'nullable|image',
        ]);

        $tempat_poster = null;

        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $tempat_poster = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $tempat_poster);
        }

        Film::create([
            'judul' => $validated['judul'],
            'sinopsis' => $validated['sinopsis'],
            'genre' => $validated['genre'],
            'tahun' => $validated['tahun'],
            'poster' => $tempat_poster,
        ]);

        return redirect()->route('admin.film')->with('succes', 'Film berhasil di tambahkan');
    }

    public function hapus($id){
        $film = Film::findOrFail($id);
        $film->delete();

        return redirect()->route('admin.film')->with('succes', 'Film berhasil di tambahkan');
    }

    public function filmEdit($id){
    $film = Film::findOrFail($id);
    return view('admin.filmedit', compact('film'));
}

public function edit(Request $request, $id){
    $film = Film::findOrFail($id);

    $request->validate([
        'judul' => 'required|string',
        'sinopsis' => 'required|string|max:255',
        'genre' => 'required|string|max:100',
        'tahun' => 'required|date',
        'poster' => 'nullable|image',
    ]);

    // Update semua field yang divalidasi
    $film->judul = $request->judul;
    $film->sinopsis = $request->sinopsis;  // Field ini hilang
    $film->genre = $request->genre;        // Field ini hilang
    $film->tahun = $request->tahun;        // Field ini hilang

    if ($request->hasFile('poster')){
        // Hapus file lama jika ada
        if ($film->poster && file_exists(public_path('uploads/'. $film->poster))){
            unlink(public_path('uploads/'. $film->poster));
        }

        $file = $request->file('poster');
        $namaFile = time() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/'), $namaFile);
        $film->poster = $namaFile;
    }

    $film->save();
    return redirect()->route('admin.film'); // Typo 'succes' -> 'success'
}
public function bioskop(){
    $bioskop = Bioskop::get();
    return view('admin.daftar_bioskop', compact('bioskop'));
}

public function create_bioskop(){
    return view('admin.bioskop_create');
}

public function bioskopPost(Request $request)
{
    $validate = $request->validate([
        'nama_bioskop' => 'required|string',
        'alamat' => 'required|string',
        'kota' => 'required|string|max:50',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'kapasitas' => 'required|integer|min:1',
        'harga_sewa' => 'required|numeric|min:0',
        'deskripsi' => 'required|string',
        'galeri.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $hargaSewa = 'Rp ' . number_format($validate['harga_sewa'], 0, ',', '.');

    // Simpan foto utama
    $fotoUtama = null;
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fotoUtama = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/bioskop'), $fotoUtama);
    }

    // Buat entri bioskop
    $bioskop = Bioskop::create([
        'nama_bioskop' => $validate['nama_bioskop'],
        'alamat' => $validate['alamat'],
        'kota' => $validate['kota'],
        'foto' => $fotoUtama,
        'kapasitas' => $validate['kapasitas'],
        'harga_sewa' => $hargaSewa,
        'deskripsi' => $validate['deskripsi'],
    ]);

    // Simpan galeri tambahan (jika ada)
    if ($request->hasFile('galeri')) {
        foreach ($request->file('galeri') as $index => $galeri) {
            $namaFile = time() . '_' . uniqid() . '.' . $galeri->getClientOriginalExtension();
            $galeri->move(public_path('uploads/bioskop'), $namaFile);

            GambarBioskop::create([
                'bioskop_id' => $bioskop->id,
                'tempat_gambar' => $namaFile,
                'sort_order' => $index + 1,
            ]);
        }
    }

    return redirect()->route('admin.bioskop')->with('success', 'Bioskop berhasil ditambahkan');
}

public function bioskopEdit($id){
    $bioskop = Bioskop::findOrFail($id);
    return view('admin.bioskopEdit', compact('bioskop'));
}

public function bioskopEP(Request $request, $id){
    $bioskop = Bioskop::findOrFail($id);

    $request->validate([
        'nama_bioskop' => 'required|string',
        'alamat' => 'required|string',
        'kota' => 'required|string|max:50',
        'foto' => 'nullable|image',
    ]);

    $bioskop->nama_bioskop = $request->nama_bioskop;
    if ($request->hasFile('foto')) {
        if ($bioskop->foto && file_exists(public_path('uploads/bioskop/' . $bioskop->foto))) {
            unlink(public_path('uploads/bioskop/' . $bioskop->foto));
        }

        $file = $request->file('foto');
        $namaFile = time() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/bioskop'), $namaFile);
        $bioskop->foto = $namaFile;
    }
    $nama_bioskop = $request->nama_bioskop;
    $bioskop->alamat = $request->alamat;
    $bioskop->kota = $request->kota;
    $bioskop->save();
    return redirect()->route('admin.bioskop');
}
public function hapusBioskop($id){
    $bioskop = Bioskop::findOrFail($id);
    $bioskop->delete();
    return redirect()->route('admin.bioskop')->with('succes', 'Film berhasil di dihapus');
    }

// METHOD BERITA YANG SUDAH DIPERBARUI DENGAN PAGINATION
public function berita(Request $request = null){
    // Menggunakan paginate() dengan 10 item per halaman
    $berita = Berita::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.berita', compact('berita'));
}

public function beritaCreate(){
    $user = Auth::user();
    return view('admin.beritaCreate', compact('user'));
}

public function beritaUp(Request $request){

    $validate = $request->validate([
        'judul_berita' => 'required|string',
        'isi_berita' => 'required|string',
        'jenis_berita' => 'required|string',
        'penulis_berita' => 'required|string|max:100',
        'tahun' => 'required|date',
        'gambar_berita' => 'nullable|image',
    ]);

    $tempat_berita = null;

    if ($request->hasfile('gambar_berita')){
        $fileberita = $request->file('gambar_berita');
        $tempat_berita = time() . '.' . $fileberita->getClientOriginalExtension();
        $fileberita->move(public_path('uploads/berita'), $tempat_berita);
    }

    Berita::create([
            'judul_berita' => $validate['judul_berita'],
            'isi_berita' => $validate['isi_berita'],
            'jenis_berita' => $validate['jenis_berita'],
            'penulis_berita' => $validate['penulis_berita'],
            'tahun' => $validate['tahun'],
            'gambar_berita' => $tempat_berita,
        ]);

    return redirect()->route('admin.berita');
}

public function beritaHapus($id){
    $berita = Berita::findOrFail($id);
    $berita->delete();

    return redirect()->route('admin.berita');
}

public function beritaEdit($id){
    $berita = Berita::findOrFail($id);
    return view('admin.beritaEdit', compact('berita'));
}

public function beritaEP(Request $request, $id){
    $berita = Berita::findOrFail($id);

    $request->validate([
        'judul_berita' => 'required|string',
        'isi_berita' => 'required|string',
        'jenis_berita' => 'required|string',
        'penulis_berita' => 'required|string|max:100',
        'tahun' => 'required|date',
        'gambar_berita' => 'nullable|image',
    ]);

    $berita->judul_berita = $request->judul_berita;
    $berita->isi_berita = $request->isi_berita;
    $berita->jenis_berita = $request->jenis_berita;
    $berita->penulis_berita = $request->penulis_berita;
    $berita->tahun = $request->tahun;

    if ($request->hasFile('gambar_berita')) {
        if ($berita->gambar_berita && file_exists(public_path('uploads/berita/' . $berita->gambar_berita))) {
            unlink(public_path('uploads/berita/' . $berita->gambar_berita));
        }

        $file = $request->file('gambar_berita');
        $namaFile = time() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/berita'), $namaFile);
        $berita->gambar_berita = $namaFile;
    }

    $berita->save();
    return redirect()->route('admin.berita');
}

public function tentang(){
    $tentang = Tentang::get();
    return view('admin.tentang', compact('tentang'));
}

public function tentangCreate(){
    return view('admin.tentangCreate');
}

public function tentangUp(Request $request){
        $validate = $request->validate([
            'judul_tentang' => 'required|string',
            'isi_tentang' => 'required|string',
            'nomor_tentang' => 'required',
            'image_tentang' => 'nullable|image',
            'image1' => 'nullable|image',
        ]);

        $tempat_tentang = null;
        if ($request->hasfile('image_tentang')){
            $file = $request->file('image_tentang');
            $tempat_tentang = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/tentang'), $tempat_tentang);
        }

        $tempat_tentang1 = null;
        if ($request->hasfile('image1')){
            $file2 = $request->file('image1');
            $tempat_tentang1 = time() . '_1.' . $file2->getClientOriginalExtension();
            $file2->move(public_path('uploads/tentang'), $tempat_tentang1);
        }

        Tentang::create([
            'judul_tentang' => $validate['judul_tentang'],
            'isi_tentang' => $validate['isi_tentang'],
            'nomor_tentang' => $validate['nomor_tentang'],
            'image_tentang' => $tempat_tentang,
            'image1' => $tempat_tentang1,
        ]);

        return redirect()->route('admin.tentang');
    }

    public function tentangHapus($id){
        $tentang = Tentang::FindOrFail($id);
        $tentang->delete();
        return redirect()->route('admin.tentang');
    }

    public function gallery(){
        $gallery = Gallery::get();
        return view('admin.gallery', compact('gallery'));
    }

    public function galleryCreate(){
        return view('admin.galleryCreate');
    }

    public function galleryUp(Request $request){
        $validate = $request->validate([
            'gambar_gallery' => 'required|image',
        ]);

        $tempat_gallery = null;
        if ($request->hasfile('gambar_gallery')){
            $file = $request->file('gambar_gallery');
            $tempat_gallery = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery'), $tempat_gallery);
        }

        Gallery::create([
            'gambar_gallery' => $tempat_gallery,
        ]);

        return redirect()->route('admin.gallery');
    }

    public function galleryHapus($id){
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect()->route('admin.gallery')->with('succes', 'Gallery berhasil dihapus');
    }

}
