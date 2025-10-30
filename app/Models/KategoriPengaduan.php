<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'kategori_id';
    protected $table = 'kategori_pengaduan';

    protected $fillable = [
        'nama',
        'sla_hari',
        'prioritas'
    ];

    // Relasi ke pengaduan
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id', 'kategori_id');
    }
}
