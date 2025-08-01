<?php

namespace App\Models;

use App\Models\BioskopRental;
use App\Models\GambarBioskop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bioskop extends Model
{
    use HasFactory;

    protected $fillable = ['nama_bioskop', 'alamat', 'kapasitas', 'harga_sewa', 'kota', 'foto', 'deskripsi'];

    public function bioskopRentals()
    {
        return $this->hasMany(BioskopRental::class, 'bioskop_id');
    }

    public function gambarBioskop()
    {
        return $this->hasMany(GambarBioskop::class, 'bioskop_id', 'id')->orderBy('sort_order');
    }

    public function gambarUtama()
    {
        // Prioritas 1: Foto utama
        if ($this->foto) {
            return asset('uploads/bioskop/' . $this->foto);  // Fix: bukan 'uploads/berita/'
        }

        // Prioritas 2: Gambar pertama dari gallery
        $firstImage = $this->gambarBioskop()->first();
        if ($firstImage) {
            return asset('uploads/bioskop/' . $firstImage->tempat_gambar);
        }

        // Prioritas 3: Return null jika tidak ada gambar
        return null;
    }

    public function semuaGambar()
    {
        return $this->gambarBioskop()->get()->map(function ($gambar) {
            return asset('uploads/bioskop/' . $gambar->tempat_gambar);
        });
    }

    // Method tambahan untuk cek apakah punya gambar
    public function hasImages()
    {
        return $this->foto || $this->gambarBioskop()->exists();
    }

    // Method untuk mendapatkan semua URL gambar (foto utama + gallery)
    public function allImages()
    {
        $images = collect();

        // Tambahkan foto utama jika ada
        if ($this->foto) {
            $images->push(asset('uploads/bioskop/' . $this->foto));
        }

        // Tambahkan gambar dari gallery
        $galleryImages = $this->semuaGambar();
        $images = $images->merge($galleryImages);

        return $images;
    }

    public function setHargaSewaAttribute($value)
    {
        // Hapus 'Rp', spasi, dan separator untuk menyimpan angka murni
        $this->attributes['harga_sewa'] = (int) preg_replace('/[^0-9]/', '', $value);
    }
}
