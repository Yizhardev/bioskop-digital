<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';
    protected $fillable = ['judul_berita', 'isi_berita', 'jenis_berita', 'penulis_berita', 'gambar_berita', 'tahun'];
}
