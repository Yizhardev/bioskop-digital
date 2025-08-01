<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarBioskop extends Model
{
    use HasFactory;

    protected $table = 'gambar_bioskop';
    protected $fillable = ['bioskop_id', 'gambar', 'tempat_gambar', 'sort_order'];
    protected $casts = [
        'sort_order' => 'integer',
        'bioskop_id' => 'integer'
    ];

    public function bioskop()
    {
        return $this->belongsTo(Bioskop::class, 'bioskop_id', 'id');
    }

    // Accessor untuk URL gambar
    public function getUrlAttribute()
    {
        return $this->tempat_gambar ? asset('uploads/bioskop/' . $this->tempat_gambar) : null;
    }

    // Scope untuk ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Method untuk cek file exists
    public function fileExists()
    {
        return $this->tempat_gambar && file_exists(public_path('uploads/bioskop/' . $this->tempat_gambar));
    }
}
