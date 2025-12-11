<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianLayanan extends Model
{
    use HasFactory;

    protected $table = 'penilaian_layanan';
    protected $primaryKey = 'penilaian_id';

    protected $fillable = [
        'pengaduan_id',
        'rating',
        'komentar',
    ];

    /**
     * Scope filter 
     */
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

    /**
     * Relasi ke pengaduan
     */
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'pengaduan_id');
    }

    /**
     * Accessor untuk rating bintang
     */
    public function getRatingBintangAttribute()
    {
        return str_repeat('⭐', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Accessor untuk rating text
     */
    public function getRatingTextAttribute()
    {
        $texts = [
            1 => 'Sangat Tidak Puas',
            2 => 'Tidak Puas',
            3 => 'Cukup Puas',
            4 => 'Puas',
            5 => 'Sangat Puas',
        ];
        return $texts[$this->rating] ?? 'Tidak Ada Rating';
    }
}
