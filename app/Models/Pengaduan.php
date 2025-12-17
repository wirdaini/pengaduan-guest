<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    /**
     * Scope search
     */
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }

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

    // TAMBAHKAN RELASI KE PENILAIAN
    public function penilaian()
    {
        return $this->hasOne(PenilaianLayanan::class, 'pengaduan_id', 'pengaduan_id');
    }

    // Relasi ke tindak lanjut (jika belum ada)
    public function tindakLanjut()
    {
        return $this->hasMany(TindakLanjut::class, 'pengaduan_id', 'pengaduan_id');
    }
}
