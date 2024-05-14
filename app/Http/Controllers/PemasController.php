<?php

namespace App\Http\Controllers;

use App\Models\pemas;
use App\Models\FormPemas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PemasController extends Controller
{
    public function index()
    {
        return view('pemas.postingPemas');
    }
    public function request()
    {
        return view('pemas.pengajuanPemas');
    }

    public function indexAdmin()
    {
        $pengmases = pemas::all();
        return view('tamplate.dashboard.menuadmin.menuPemas', compact('pengmases'));
    }
    public function editAdmin($slug)
    {
        $pemas = pemas::where('slug', $slug)->first();
        return view('tamplate.dashboard.menuadmin.edit-pemas', compact('pemas'));
    }
    public function updateAdmin(Request $request, $slug)
    {
        // Mengambil berita berdasarkan slug
        $pemas = pemas::where('slug', $slug)->first();
        // Validasi request
        $request->validate([
            'status' => 'required|in:Proses verifikasi,Diterima,Ditolak', // Validasi status
        ]);
        $pemas->status = $request->status;
        $pemas->save();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status berita berhasil diperbarui.');
    }
    public function store(Request $request)
    { // Validasi form
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Umum,Kesehatan,Energi,Industri,Pangan',
            'location' => 'required|string', // Menambahkan validasi untuk lokasi
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:6144', // Tambahkan validasi untuk tipe gambar dan ukuran maksimum
        ]);

        // Proses penyimpanan berita
        $pemas = new pemas();
        $pemas->name = $request->input('name');
        $pemas->category = $request->input('category');
        $pemas->status = $request->input('status');
        $pemas->location = $request->input('location');
        $pemas->content = $request->input('content');
        $pemas->slug = hash('sha256', $request->input('name'));
        $pemas->status = 'Proses Verifikasi';


        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $pemas->image = $imageName;
        }

        $pemas->user_id = auth()->user()->id;
        $pemas->save();


        return redirect()->route('pemas')->with('success', 'Berhasil Diajukan! silahkan cek menu pengabdian');
    }

    public function storeForm(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'noID' => 'nullable|string',
            'nama_kegiatan' => 'required|string',
            'location' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => ['required', 'date', 'after_or_equal:start_time'],
            'category' => 'required|string',
            'content' => 'required|string',
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat instansi baru dari model FormPemas
        $formPemas = new FormPemas();

        // Mengisi properti dari instansi dengan data dari request
        $formPemas->name = auth()->user()->name;
        $formPemas->noID = $request->input('noID');
        $formPemas->nama_kegiatan = $request->input('nama_kegiatan');
        $formPemas->location = $request->input('location');
        $formPemas->start_time = $request->input('start_time');
        $formPemas->end_time = $request->input('end_time');
        $formPemas->category = $request->input('category');
        $formPemas->content = $request->input('content');

        // Menyimpan data ke basis data
        $formPemas->save();

        // Redirect ke halaman atau rute yang diinginkan dengan pesan sukses
        return redirect()->back()->with('success', 'Data kegiatan berhasil disimpan.');
    }

    public function detailpemas($slug)
    {
        $pemas = pemas::whereSlug($slug)->first();
        $pemas->created = $pemas->created_at->format('M jS Y');
        return view('pemas.pemas_detail', compact('pemas'));
    }
}
