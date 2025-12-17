<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
    ];

    // Scope filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                // Handle filter khusus untuk created_at (date range)
                if ($column === 'created_at') {
                    $this->applyDateFilter($query, $request->input('created_at'));
                }
                // Filter biasa
                else {
                    $query->where($column, $request->input($column));
                }
            }
        }
        return $query;
    }

    /**
     * Filter berdasarkan tanggal
     */
    private function applyDateFilter(Builder $query, $dateFilter): void
    {
        $today = now()->format('Y-m-d');

        switch ($dateFilter) {
            case 'today':
                $query->whereDate('created_at', $today);
                break;
            case 'week':
                $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek(),
                ]);
                break;
            case 'month':
                $query->whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ]);
                break;
        }
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Relationship dengan pengaduan jika user adalah warga
    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'warga_id');
    }

    // Helper method untuk mengecek role
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPetugas()
    {
        return $this->role === 'petugas';
    }

    public function isWarga()
    {
        return $this->role === 'warga';
    }

    // Di dalam class User
/**
 * Get the URL for the profile picture.
 */
    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }
        return asset('images/default-profile.jpg'); // Foto default
    }
}
