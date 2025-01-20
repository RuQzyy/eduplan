<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'request';
    protected $primaryKey = 'id_request';
    protected $fillable = [
        'id_dosen',
        'id_ruangan',
        'waktu_mulai',
        'waktu_selesai',
        'status_request',
        'tanggal_request',
    ];
}
