<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan'; // Nama tabel di database
    protected $primaryKey = 'id_ruangan'; // Primary key
    public $timestamps = true; // Jika tabel menggunakan timestamps
    protected $fillable =
    [
        'id_ruangan',
        'status_ruangan',
        'catatan',
        'nama_ruangan'
    ];
}
