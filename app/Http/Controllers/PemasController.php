<?php

namespace App\Http\Controllers;

use App\Models\pemas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PemasController extends Controller
{
    public function index()
    {
        return view('pemas.pengajuanPemas');
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
        $pemas->location = $request->input('location');
        $pemas->content = $request->input('content');
        $pemas->slug = hash('sha256', $request->input('name')); // Menggunakan SHA256 hashing

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
}
