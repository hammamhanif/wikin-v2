<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class NewsController extends Controller
{
    public function post()
    {
        return view('tamplate.dashboard.menu.postberita');
    }

    public function index()
    {
        // Mengambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil semua berita yang dibuat oleh pengguna yang sedang login
        $news = News::where('user_id', $userId)->get();

        // Mengembalikan data berita menggunakan compact
        return view('tamplate.dashboard.menu.informasi', compact('news'));
    }

    public function  indexAdmin()
    {
        $news = News::all(); // Mendapatkan semua berita
        return view('tamplate.dashboard.menuadmin.menuNews', compact('news'));
    }
    public function edit($slug)
    {
        // Mengambil berita berdasarkan slug
        $news = News::where('slug', $slug)->first();

        // Periksa apakah berita ditemukan dan apakah pengguna memiliki izin untuk mengeditnya
        if (!$news || $news->user_id !== Auth::id()) {
            return redirect()->route('informasi')->with('error', 'Berita tidak ditemukan atau Anda tidak memiliki izin untuk mengeditnya.');
        }

        return view('tamplate.dashboard.menu.edit-informasi', compact('news'));
    }
    public function editAdmin($slug)
    {
        // Mengambil berita berdasarkan slug
        $news = News::where('slug', $slug)->first();

        return view('tamplate.dashboard.menuadmin.edit-informasi', compact('news'));
    }

    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:6144', // Tambahkan validasi untuk tipe gambar dan ukuran maksimum
            'category' => 'required|in:Umum,Kesehatan,Energi,Industri,Pangan', // Validasi kategori
        ]);

        // Proses penyimpanan berita
        $news = new News();
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category = $request->input('category');
        $news->status = 'verifikasi';
        $slug = hash('sha256', $request->input('title') . time());
        $news->slug = $slug;

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = hash('sha256', $image->get()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $news->image = $imageName;
        }


        $news->user_id = auth()->user()->id;
        $news->save();

        return redirect()->back()->with('success', 'Informasi berhasil disimpan!');
    }
    public function delete($id)
    {
        // Mengambil berita yang akan dihapus
        $news = News::find($id);

        if (!$news || $news->user_id !== Auth::id()) {
            return redirect()->route('informasi')->with('error', 'Berita tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.');
        }

        // Menghapus gambar dari folder public/images jika ada
        if ($news->image) {
            $imagePath = public_path('images') . '/' . $news->image;

            // Hapus gambar hanya jika file tersebut ada
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Menghapus berita dari database
        $news->delete();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }
    public function updateAdmin(Request $request, $slug)
    {
        // Mengambil berita berdasarkan slug
        $news = News::where('slug', $slug)->first();
        // Validasi request
        $request->validate([
            'status' => 'required|in:verifikasi,inactive,active', // Validasi status
        ]);
        $news->status = $request->status;
        $news->save();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status berita berhasil diperbarui.');
    }
    public function update(Request $request, $slug)
    {
        // Mengambil berita berdasarkan slug
        $news = News::where('slug', $slug)->first();

        // Periksa apakah berita ditemukan dan apakah pengguna memiliki izin untuk mengeditnya
        if (!$news || $news->user_id !== Auth::id()) {
            return redirect()->route('informasi')->with('error', 'Berita tidak ditemukan atau Anda tidak memiliki izin untuk mengeditnya.');
        }

        // Validasi request
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh validasi untuk gambar
        ]);

        // Update data berita
        $news->title = $request->title;
        $news->content = $request->content;

        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($news->image) {
                $imagePath = public_path('images') . '/' . $news->image;
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $news->image = $imageName;
        }

        // Simpan perubahan
        $news->save();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('informasi')->with('success', 'Berita berhasil diperbarui.');
    }

    public function Reportstore(Request $request)
    {
        // Validasi input
        $request->validate([
            'news_id' => 'required|exists:news,id',
            'description' => 'required|string',
        ]);

        // Simpan laporan ke database
        $report = new Report();
        $report->news_id = $request->news_id;
        $report->reported_by_user_id = auth()->id(); // User yang sedang login
        $report->reported_user_id = News::findOrFail($request->news_id)->user_id;
        $report->description = $request->input('description');
        $report->save();

        return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
    }
}
