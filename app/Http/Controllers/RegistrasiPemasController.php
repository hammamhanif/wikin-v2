<?php

namespace App\Http\Controllers;

use App\Models\pemas;
use Illuminate\Http\Request;
use App\Models\RegistrasiPemas;

class RegistrasiPemasController extends Controller
{
    public function index($slug)
    {
        $pemas = pemas::where('slug', $slug)->firstOrFail();
        return view('pemas.registrasiPemas', compact('pemas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'pemas_id' => 'required|exists:pemas,id',
            'nama' => 'required|string|max:255',
            'noID' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'program_study' => 'required|string|max:255',
            'type' => 'required|in:dosen,mahasiswa',
            'motivasi' => 'required|string',
        ]);

        $registrasiPemas = RegistrasiPemas::create([
            'user_id' => auth()->user()->id,
            'pemas_id' => $request->pemas_id,
            'judul' => $request->judul,
            'nama' => $request->nama,
            'noID' => $request->noID,
            'alamat' => $request->alamat,
            'program_study' => $request->program_study,
            'type' => $request->type,
            'motivasi' => $request->motivasi,
        ]);
        $registrasiPemas->save();
        return  redirect()->back()->with('success', 'Berhasil mendaftar pengabdian masyarakat');
    }
}
