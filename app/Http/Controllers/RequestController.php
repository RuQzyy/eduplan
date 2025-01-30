<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use Illuminate\Container\Attributes\Auth;

class RequestController extends Controller
{
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
    }
}
