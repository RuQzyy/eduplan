<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;
use App\Models\Ruangan;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class Permintaan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Atribut Wajib Diisi!',
        ];
        $request->validate([
            'id_ruangan' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'kelas' => 'required',
        ], $messages);

        $data = new ModelsRequest();
        $data->id_dosen = $request->id_dosen;
        $data->id_ruangan = $request->id_ruangan;
        $data->waktu_mulai = $request->waktu_mulai;
        $data->waktu_selesai = $request->waktu_selesai;
        $data->kelas = $request->kelas;
        $data->tanggal_request = Carbon::now();
        $data->status_request = 'Menunggu Verifikasi';
        $data->save();
        Alert::success('Sukses', 'permintaan ruangan berhasil dikirim');
        return redirect()->back();
    }

    public function terima(Request $request, $id)
    {
        $permintaan = ModelsRequest::find($id);
        $permintaan->status_request = 'Diterima';
        $permintaan->save();

        $ruangan = Ruangan::find($permintaan->id_ruangan);
        $ruangan->status_ruangan = 'Tidak Tersedia';
        $ruangan->save();
        Alert::success('Sukses', 'Ruangan Berhasil di terima');
        return redirect()->back();
    }

    public function tolak(Request $request, $id)
    {
        $permintaan = ModelsRequest::find($id);
        $permintaan->status_request = 'Ditolak';
        $permintaan->save();

        $ruangan = Ruangan::find($permintaan->id_ruangan);
        $ruangan->status_ruangan = 'Tersedia';
        $ruangan->save();
        Alert::info('Ditolak', 'Permintaan berhasil ditolak.');
        return redirect()->back();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
