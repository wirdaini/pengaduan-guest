<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';

    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'user_id',
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                // Baris ini yang penting: menambahkan kondisi WHERE
                $query->where($column, operator: $request->input($column));
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

    // Di dalam class Warga, tambah:
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'warga_id');
    }
}
