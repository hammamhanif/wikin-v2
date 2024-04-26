<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:6144', // Tambahkan validasi untuk tipe gambar dan ukuran maksimum
            'category' => 'required|in:Umum,Kesehatan,Energi,Industri,Pangan', // Validasi kategori
        ]);

        // Proses penyimpanan berita
        $news = new News();
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->content = $request->input('content');
        $news->category = $request->input('category');
        $news->slug = Str::slug($request->title); // Generate slug from the title

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $news->image = $imageName;
        }

        $news->user_id = auth()->user()->id;
        $news->save();

        return redirect()->route('dashboard')->with('success', 'Informasi berhasil disimpan!');
    }
}
