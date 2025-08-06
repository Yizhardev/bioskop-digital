<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Berita;
use App\Models\Bioskop;
use App\Models\Gallery;
use App\Models\Tentang;
use Illuminate\Http\Request;
use App\Models\BioskopRental;
use App\Models\GambarBioskop;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashboard(){
        $bioskop = Bioskop::with('gambarBioskop')->get();
        $films = Film::get();

        // Perbaikan query untuk mendapatkan data pembelian per bulan
        $currentYear = date('Y');

        $pembelianPerBulan = DB::table('transaksi')
            ->select(
                DB::raw("MONTH(created_at) as bulan"),
                DB::raw("SUM(total_harga) as total_harga")
            )
            ->where('status', 'sukses')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get()
            ->keyBy('bulan');

        // Buat array untuk 12 bulan dengan nilai default 0
        $dataChart = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataChart[] = [
                'bulan' => $i,
                'total_harga' => $pembelianPerBulan->has($i) ? (float) $pembelianPerBulan[$i]->total_harga : 0
            ];
        }

return view ('admin.dashboard', compact('films', 'bioskop', 'dataChart'));
    }


    public function dashboardMember(){
        $transaksi = auth()->user()->transaksi()->with('film')->get();
        $films = Film::get();
        return view('member.dashboard', compact('transaksi', 'films'));
    }

    public function berita(Request $request){
        // Ambil semua berita untuk hero section (3 pertama)
        $allBerita = Berita::orderBy('created_at', 'desc')->get();

        // Pagination untuk berita di bawah hero section
        $beritaPaginated = Berita::orderBy('created_at', 'desc')
                                ->skip(3)
                                ->paginate(6);

        $gallery = Gallery::get();

        // Mendapatkan kategori unik dari jenis_berita
        $kategori = Berita::select('jenis_berita')
                          ->distinct()
                          ->orderBy('jenis_berita')
                          ->pluck('jenis_berita');

        return view('berita', compact('allBerita', 'beritaPaginated', 'gallery', 'kategori'));
    }

    public function index(){
        $tentang = Tentang::get();
        $films = Film::get();
        // Mengambil bioskop dengan relasi gambar tambahan
        $bioskop = Bioskop::with(['gambarBioskop' => function($query) {
            $query->orderBy('sort_order', 'asc');
        }])->get();
        $berita = Berita::get();
        $gallery = Gallery::get();
        return view('index', compact('films', 'bioskop', 'berita', 'tentang', 'gallery'));
    }

    public function beritaFull($id){
        $berita = Berita::findOrFail($id);
        $gallery = Gallery::get();
        return view('beritaFull', compact('berita', 'gallery'));
    }

    public function filmFull($id){
        $films = Film::findOrFail($id);
        $gallery = Gallery::get();
        return view('filmFull', compact('films', 'gallery'));
    }

    public function film(){
        $films = Film::get();
        $gallery = Gallery::get();
        return view('film', compact('films', 'gallery'));
    }

    public function tentangFull($id){
        $tentang = Tentang::findOrFail($id);
        $gallery = Gallery::get();
        return view('aboutFull', compact('tentang', 'gallery'));
    }

    public function beritaData()
    {
        $berita = Berita::select('id', 'judul_berita', 'isi_berita', 'jenis_berita', 'penulis_berita', 'gambar_berita', 'created_at')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return response()->json($berita);
    }

    public function beritaByKategori($kategori)
    {
        $berita = Berita::where('jenis_berita', $kategori)
                       ->select('id', 'judul_berita', 'isi_berita', 'jenis_berita', 'penulis_berita', 'gambar_berita', 'created_at')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return response()->json($berita);
    }

    public function bioskop(){
        // Mengambil semua bioskop dengan gambar utama dan galeri tambahan
        $bioskop = Bioskop::with(['gambarBioskop' => function($query) {
            $query->orderBy('sort_order', 'asc');
        }])->get();
        $gallery = Gallery::get();
        return view('bioskop', compact('bioskop', 'gallery'));
    }

    /**
     * Method untuk menampilkan detail bioskop dengan semua gambar
     */
    public function bioskopDetail($id){
        $bioskop = Bioskop::with(['gambarBioskop' => function($query) {
            $query->orderBy('sort_order', 'asc');
        }])->findOrFail($id);

        $gallery = Gallery::get();

        return view('bioskopDetail', compact('bioskop', 'gallery'));
    }

    /**
     * Method untuk mendapatkan data bioskop dalam format JSON (untuk AJAX)
     */
    public function getBioskopData($id = null)
    {
        if ($id) {
            $bioskop = Bioskop::with(['gambarBioskop' => function($query) {
                $query->orderBy('sort_order', 'asc');
            }])->findOrFail($id);

            // Format data dengan struktur gambar utama + galeri
            $response = [
                'id' => $bioskop->id,
                'nama_bioskop' => $bioskop->nama_bioskop,
                'alamat' => $bioskop->alamat,
                'kota' => $bioskop->kota,
                'foto_utama' => $bioskop->foto ? asset('uploads/bioskop/' . $bioskop->foto) : null,
                'galeri' => $bioskop->gambarBioskop->map(function($gambar) {
                    return [
                        'id' => $gambar->id,
                        'url' => asset('uploads/bioskop/' . $gambar->tempat_gambar),
                        'sort_order' => $gambar->sort_order
                    ];
                }),
                'total_gambar' => 1 + $bioskop->gambarBioskop->count() // foto utama + galeri
            ];

            return response()->json($response);
        } else {
            $bioskop = Bioskop::with(['gambarBioskop' => function($query) {
                $query->orderBy('sort_order', 'asc');
            }])->get();

            $response = $bioskop->map(function($item) {
                return [
                    'id' => $item->id,
                    'nama_bioskop' => $item->nama_bioskop,
                    'alamat' => $item->alamat,
                    'kota' => $item->kota,
                    'foto_utama' => $item->foto ? asset('uploads/bioskop/' . $item->foto) : null,
                    'galeri_count' => $item->gambarBioskop->count(),
                    'total_gambar' => 1 + $item->gambarBioskop->count()
                ];
            });

            return response()->json($response);
        }
    }

    /**
     * Method untuk pencarian bioskop berdasarkan kota atau nama
     */
    public function searchBioskop(Request $request)
    {
        $query = $request->get('query');
        $kota = $request->get('kota');

        $bioskopQuery = Bioskop::with(['gambarBioskop' => function($q) {
            $q->orderBy('sort_order', 'asc');
        }]);

        if ($query) {
            $bioskopQuery->where('nama_bioskop', 'LIKE', '%' . $query . '%');
        }

        if ($kota) {
            $bioskopQuery->where('kota', 'LIKE', '%' . $kota . '%');
        }

        $bioskop = $bioskopQuery->get();
        $gallery = Gallery::get();

        return view('bioskop', compact('bioskop', 'gallery'));
    }

    /**
     * Method untuk mendapatkan daftar kota yang tersedia
     */
    public function getKotaBioskop()
    {
        $kota = Bioskop::select('kota')
                      ->distinct()
                      ->orderBy('kota')
                      ->pluck('kota');

        return response()->json($kota);
    }
}
