<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\pemas;
use App\Models\FormPemas;
use Illuminate\Http\Request;
use App\Models\RegistrasiPemas;
use Illuminate\Validation\Rule;

class RegistrasiPemasController extends Controller
{
    public function index($slug)
    {
        $pemas = pemas::where('slug', $slug)->firstOrFail();
        return view('pemas.registrasiPemas', compact('pemas'));
    }


    public function indexMember(Request $request, $slug)
    {
        // Dapatkan Pemas berdasarkan slug
        $pemas = FormPemas::where('slug', $slug)->firstOrFail();

        // Dapatkan semua RegistrasiPemas yang memiliki pemas_id yang sama
        $registrasiPemas = RegistrasiPemas::where('form_pemas_id', $pemas->id)->get();

        // Dapatkan semua pengguna
        $users = User::where('type', 'dosen')
            ->orWhere('type', 'mahasiswa')
            ->get();


        // Kembalikan view dengan data Pemas, RegistrasiPemas, dan pengguna
        return view('pemas.memberpemas', compact('pemas', 'registrasiPemas', 'users'));
    }

    public function indexAdmin($slug)
    {
        // Dapatkan Pemas berdasarkan slug
        $pemas = Pemas::where('slug', $slug)->firstOrFail();

        // Dapatkan semua RegistrasiPemas yang memiliki pemas_id yang sama
        $registrasiPemas = RegistrasiPemas::where('form_pemas_id', $pemas->id)->get();

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
        // Check if the user has already submitted the form
        $existingRegistration = RegistrasiPemas::where('user_id', auth()->user()->id)->exists();

        if ($existingRegistration) {
            // If the user has already submitted the form, return an error response
            return redirect()->back()->withErrors(['error' => 'Anda sudah mengisi formulir ini sebelumnya.']);
        }
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'form_pemas_id' => 'required|exists:pemas,id',
            'noID' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'program_study' => 'required|string|max:255',
            'type' => 'required|in:dosen,mahasiswa',
            'motivasi' => 'required|string',
        ]);

        $registrasiPemas = RegistrasiPemas::create([
            'user_id' => auth()->user()->id,
            'form_pemas_id' => $request->form_pemas_id,
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
    public function storeAuthor(Request $request)
    {
        $request->validate([
            'form_pemas_id' => 'required|exists:pemas,id',
            'program_study' => 'required|string|max:255',
            'type' => 'required|in:dosen,mahasiswa,admin',
            'user_id' => [
                'required',
                Rule::unique('registrasi_pemas')->where(function ($query) use ($request) {
                    return $query->where('form_pemas_id', $request->form_pemas_id);
                }),
            ],
        ]);

        $registrasiPemas = RegistrasiPemas::create([
            'form_pemas_id' => $request->form_pemas_id,
            'user_id' => $request->user_id,
            'noID' => $request->user_id,
            'alamat' => 'Poltek Nuklir',
            'program_study' => $request->program_study,
            'type' => $request->type,
            'motivasi' => 'rekan tambahan',
            'status' => 'diterima',
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar pengabdian masyarakat, silahkan cek menu anggota pengabdian');
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
