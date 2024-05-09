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
        return view('komunitas.pengajuanKomunitas');
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

        $imageHashName = null;
        if ($imagePath) {
            $imageHashName = Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('images/community', $imageHashName);
        }
        $community = new Communities;
        $community->name = $request->name;
        $community->category = $request->category;
        $community->content = $request->content;
        $community->slug = hash('sha256', $slug);
        $community->image = $imageHashName;
        $community->user_id = Auth::id(); // Mengambil ID user yang sedang login
        if (substr($request->number, 0, 1) === '0') {
            $community->number = '62' . substr($request->number, 1);
        } else {
            $community->number = $request->number;
        }
        $community->save();

        // Redirect ke halaman yang tepat dengan pesan sukses
        return redirect()->back()->with('success', 'Community added successfully.');
    }
}
