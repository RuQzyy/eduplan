<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $permintaan = DB::table('request')
            ->join('ruangan', 'request.id_ruangan', 'ruangan.id_ruangan')
            ->join('users', 'request.id_dosen', 'users.id')
            ->where('status_request', '=', 'Menunggu Verifikasi')
            ->get();
        return view('admin.dashboard', compact('permintaan')); // Mengarahkan ke view dashboard
    }

    public function ruangan()
    {
        return view('admin.ruangan'); // Mengarahkan ke view ruangan
    }
}
