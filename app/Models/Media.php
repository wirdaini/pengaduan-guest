<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
    ];
}

    // // URL file
    // public function getFileUrlAttribute()
    // {
    //     return asset('uploads/' . $this->file_name);
    // }

    // // Tipe file
    // public function getFileTypeAttribute()
    // {
    //     if (str_starts_with($this->mime_type, 'image/')) {
    //         return 'image';
    //     } elseif ($this->mime_type == 'application/pdf') {
    //         return 'pdf';
    //     } else {
    //         return 'other';
    //     }
    // }

    // // TAMBAHKAN INI! Nama untuk ditampilkan
    // public function getDisplayNameAttribute()
    // {
    //     // Jika ada caption, pakai caption (nama asli)
    //     if (! empty($this->caption)) {
    //         return $this->caption;
    //     }

    //     // Jika tidak, coba ambil dari file_name (hapus timestamp)
    //     $name = $this->file_name;

    //     // Hapus timestamp di depan: "1765278284_nama-file.jpg" → "nama-file.jpg"
    //     if (preg_match('/^\d+_(.+)$/', $name, $matches)) {
    //         return $matches[1];
    //     }

    //     return $name;
    // }
