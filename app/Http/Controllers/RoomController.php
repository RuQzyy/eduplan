<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan; // Pastikan model Ruangan sudah dibuat

class RoomController extends Controller
{
    public function index()
    {
        // Daftar ruangan statis (contoh)
        $rooms = [
            "A201", "A202", "A203", "A301", "A302", "A303", "A401", "A402", "A403", "A501",
            "B201", "B202", "B203", "B301", "B302", "B303", "B401", "B402", "B403", "B501",
            "C201", "C202", "C203", "C301", "C302", "C303", "C401"
        ];

        // Ambil status ruangan dari database
        $roomStatus = Ruangan::pluck('status_ruangan', 'id_ruangan')->toArray();

        // Kirim data ke view
        return view('dosen.ruangan', compact('rooms', 'roomStatus'));
    }
}
