<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Menampilkan halaman ruangan dosen.
     */
    public function index()
    {
        $ruang = DB::table('ruangan')->get();

        return view('dosen.ruangan', compact('ruang'));
    }

    /**
     * Menampilkan dashboard dosen.
     */
    public function dashboard()
    {
        $jadwal = DB::table('request')
            ->join('ruangan', 'request.id_ruangan', 'ruangan.id_ruangan')
            ->where('request.status_request', '=', 'Diterima')
            ->get();

        // Kirim data ke view dashboard
        return view('dosen.dashboard', compact('jadwal'));
    }

    /**
     * Mengambil ruangan untuk digunakan.
     */
    public function takeRoom(Request $request)
    {
        $roomId = $request->input('room_id'); // Mengambil ID ruangan dari request

        // Validasi input ruangan
        if (!$roomId) {
            return redirect()->back()->with('error', 'Ruangan tidak valid.');
        }

        // Cari ruangan di database
        $room = Ruangan::where('id_ruangan', $roomId)->first();

        // Periksa apakah ruangan tersedia
        if ($room && $room->status_ruangan === 'tersedia') {
            // Ubah status ruangan menjadi "tidak tersedia"
            $room->status_ruangan = 'tidak tersedia';
            $room->save();

            return redirect()->back()->with('success', 'Ruangan berhasil diambil.');
        }

        return redirect()->back()->with('error', 'Ruangan tidak tersedia.');
    }
}
