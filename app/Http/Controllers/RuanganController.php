<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = DB::table('ruangan');
        return view('ruangan.index', compact('ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required',
        ]);
        $data = new Ruangan();
        $data->status_ruangan = 'tersedia';
        $data->nama_ruangan = $request->nama_ruangan;
        $data->save();

        Alert::success('Sukses', 'Permintaan Dikirim ke admin');
        return redirect()->route('ruangan.index');
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
        $ruangan = Ruangan::find($id);
        $ruangan->status_ruangan = 'Tersedia';
        $ruangan->save();
        Alert::success('Sukses', 'Ruangan telah diperbarui');
        return redirect()->route('ruangan');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
