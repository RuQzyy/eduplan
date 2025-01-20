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
        // Data ruangan statis
        $ruang = DB::table('ruangan')->get();
        // $rooms = [
        //     "A201",
        //     "A202",
        //     "A203",
        //     "A301",
        //     "A302",
        //     "A303",
        //     "A401",
        //     "A402",
        //     "A403",
        //     "A501",
        //     "B201",
        //     "B202",
        //     "B203",
        //     "B301",
        //     "B302",
        //     "B303",
        //     "B401",
        //     "B402",
        //     "B403",
        //     "B501",
        //     "C201",
        //     "C202",
        //     "C203",
        //     "C301",
        //     "C302",
        //     "C303",
        //     "C401"
        // ];

        // Ambil status ruangan dari database
        // $roomStatus = Ruangan::pluck('status_ruangan', 'id_ruangan')->toArray();

        // Kirim data ke view ruangan
        return view('dosen.ruangan', compact('ruang'));
    }

    /**
     * Menampilkan dashboard dosen.
     */
    public function dashboard()
    {
        // Periksa apakah tabel 'requests' ada sebelum query
        // if (DB::getSchemaBuilder()->hasTable('requests')) {
        //     $requests = DB::table('requests')->where('status', 'pending')->get();
        // } else {
        //     $requests = []; // Jika tabel tidak ada, kirimkan array kosong
        // }
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
