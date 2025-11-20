<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'pengaduan_id';
    protected $table      = 'pengaduan';

    protected $fillable = [
        'nomor_tiket',
        'warga_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'status',
        'lokasi_text',
        'rt',
        'rw',
    ];

    // Relasi ke warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriPengaduan::class, 'kategori_id', 'kategori_id');
    }
}
