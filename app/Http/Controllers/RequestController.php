<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use Illuminate\Container\Attributes\Auth;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang dikirim
        // $validatedData = $request->validate([
        //     'id_ruangan' => 'required|integer',
        //     'id_dosen' => 'required|integer',
        //     'waktu_mulai' => 'required|date_format:H:i',
        //     'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        //     'status_request' => 'required',
        // ]);

        // // Simpan data ke dalam database
        // $newRequest = RequestModel::create($validatedData);

        // // Berikan respons
        // return response()->json([
        //     'message' => 'Request berhasil disimpan',
        //     'data' => $newRequest,
        // ], 201);
        $messages = [
            'required' => 'Atribut Wajib Diisi!',
        ];
        $request->validate([
            'id_ruangan' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
        ], $messages);
    }
}
