<?php

namespace App\Http\Controllers;

use App\Models\Communities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunitiesController extends Controller
{
    public function create()
    {
        return view('komunitas.pengajuanKomunitas'); // Mengembalikan view form untuk menambahkan komunitas baru
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Umum,Kesehatan,Energi,Industri,Pangan',
            'content' => 'required|string',
            // Tidak memvalidasi slug karena akan dihasilkan secara otomatis
            'link-number' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mengunggah gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/community');
        } else {
            $imagePath = null;
        }

        // Generate slug menggunakan nama komunitas yang dihash
        $slug = Str::slug($request->name) . '-' . Str::random(8);

        // Generate nama hash untuk gambar jika ada
        $imageHashName = null;
        if ($imagePath) {
            $imageHashName = Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();
            // Simpan gambar dengan nama hash
            $request->file('image')->storeAs('images/community', $imageHashName);
        }

        // Membuat entri baru dalam tabel communities
        $community = new Communities;
        $community->name = $request->name;
        $community->category = $request->category;
        $community->content = $request->content;
        $community->slug = $slug;
        $community->link_number = $request->link_number;
        $community->image = $imageHashName;
        $community->user_id = Auth::id(); // Mengambil ID user yang sedang login
        $community->save();

        // Redirect ke halaman yang tepat dengan pesan sukses
        return redirect()->back()->with('success', 'Community added successfully.');
    }
}
