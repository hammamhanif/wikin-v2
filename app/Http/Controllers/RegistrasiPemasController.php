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
    public function indexMember($slug)
    {
        // Dapatkan Pemas berdasarkan slug
        $pemas = Pemas::where('slug', $slug)->firstOrFail();

        // Dapatkan semua RegistrasiPemas yang memiliki pemas_id yang sama
        $registrasiPemas = RegistrasiPemas::where('pemas_id', $pemas->id)->get();

        // Kembalikan view dengan data Pemas dan RegistrasiPemas
        return view('pemas.memberpemas', compact('pemas', 'registrasiPemas'));
    }
    public function indexAdmin($slug)
    {
        // Dapatkan Pemas berdasarkan slug
        $pemas = Pemas::where('slug', $slug)->firstOrFail();

        // Dapatkan semua RegistrasiPemas yang memiliki pemas_id yang sama
        $registrasiPemas = RegistrasiPemas::where('pemas_id', $pemas->id)->get();

        // Kembalikan view dengan data Pemas dan RegistrasiPemas
        return view('tamplate.dashboard.menuadmin.memberpemas', compact('pemas', 'registrasiPemas'));
    }
    public function getByUser()
    {
        $userId = auth()->user()->id;
        $registrasiPemas = RegistrasiPemas::where('user_id', $userId)->get();

        return view('pemas.detailMemberpemas', compact('registrasiPemas'));
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
            'status' => 'Proses Verifikasi',
        ]);
        $registrasiPemas->save();
        return  redirect()->back()->with('success', 'Berhasil mendaftar pengabdian masyarakat, silahkan cek menu anggota pengabdian');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Proses verifikasi,Diterima,Ditolak',
        ]);

        $registrasiPemas = RegistrasiPemas::findOrFail($id);
        $registrasiPemas->status = $request->status;
        $registrasiPemas->save();

        return redirect()->back()->with('success', 'Status pengabdian masyarakat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $registrasiPemas = RegistrasiPemas::findOrFail($id);
        $registrasiPemas->delete();

        return redirect()->back()->with('success', 'Anggota Pendaftaran pengabdian masyarakat berhasil dihapus');
    }
    public function destroyUser($id)
    {
        $registrasiPemas = RegistrasiPemas::findOrFail($id);
        $registrasiPemas->delete();

        return redirect()->back()->with('success', 'Anggota Pendaftaran pengabdian masyarakat berhasil dihapus');
    }
    public function destroyAdmin($id)
    {
        $registrasiPemas = RegistrasiPemas::findOrFail($id);
        $registrasiPemas->delete();

        return redirect()->back()->with('success', 'Anggota Pendaftaran pengabdian masyarakat berhasil dihapus');
    }
}
