<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Communities;
use Illuminate\Http\Request;
use App\Models\RegistrasiCommunities;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class RegistrasiCommunitiesController extends Controller
{

    public function index($slug)
    {
        $communities = Communities::where('slug', $slug)->firstOrFail();
        $user = auth()->user();
        return view('tamplate.dashboard.menu.registrasiKomunitas', compact('communities', 'user'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'argument' => 'required|string',
            'community_id' => 'required|exists:communities,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Buat pendaftaran komunitas baru
            RegistrasiCommunities::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'argument' => $request->argument,
                'community_id' => $request->community_id,
            ]);

            return redirect()->back()->with('success', 'Berhasil mengajukan gabung komunitas.');
        } catch (QueryException $e) {
            // Tangkap pelanggaran constraint unik
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Anda sudah terdaftar dalam komunitas ini.')->withInput();
            }

            // Tangkap exception lain
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mendaftar.')->withInput();
        }
    }
    public function storeAuthor(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'community_id' => 'required|exists:communities,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Buat pendaftaran komunitas baru
            RegistrasiCommunities::create([
                'user_id' => $request->user_id,
                'status' => 'Diterima',
                'name' => $request->name,
                'argument' => 'penambahan internal pembuat komunitas',
                'community_id' => $request->community_id,
            ]);

            return redirect()->back()->with('success', 'Berhasil mengajukan gabung komunitas.');
        } catch (QueryException $e) {
            // Tangkap pelanggaran constraint unik
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Anda sudah terdaftar dalam komunitas ini.')->withInput();
            }

            // Tangkap exception lain
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mendaftar.')->withInput();
        }
    }

    public function editStatus($slug)
    {
        // Retrieve the specific Communities record based on the slug
        $community = Communities::where('slug', $slug)->firstOrFail();

        // Retrieve the related RegistrasiCommunities records
        $registrasiCommunities = RegistrasiCommunities::where('community_id', $community->id)->get();

        // Dapatkan semua pengguna
        $users = User::all(); // Mengambil semua data pengguna

        // Pass both to the view
        return view('tamplate.dashboard.menu.daftarMemberKomunitas', compact('community', 'registrasiCommunities', 'users'));
    }


    // Method to update the status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $community = RegistrasiCommunities::findOrFail($id);
        $community->status = $request->input('status');
        $community->save();

        return redirect()->back()
            ->with('success', 'Status updated successfully.');
    }

    public function destroy($id)
    {
        // Cari pendaftaran komunitas berdasarkan ID
        $registration = RegistrasiCommunities::find($id);



        // Hapus pendaftaran komunitas
        $registration->delete();

        return redirect()->back()->with('success', 'Pendaftaran komunitas berhasil dihapus.');
    }
}
