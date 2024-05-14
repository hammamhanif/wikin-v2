<?php

namespace App\Http\Controllers;

use App\Models\Communities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CommunitiesController extends Controller
{

    public function index()
    {
        $communities = Communities::where('user_id', Auth::id())->get();
        return view('tamplate.dashboard.menu.komunitas', compact('communities'));
    }

    public function indexAdmin()
    {
        $communities = Communities::all();
        return view('tamplate.dashboard.menuadmin.menuKomunitas', compact('communities'));
    }

    public function create()
    {
        return view('komunitas.pengajuanKomunitas');
    }

    public function edit($slug)
    {
        // Mengambil berita berdasarkan slug
        $community = Communities::where('slug', $slug)->first();

        // Periksa apakah berita ditemukan dan apakah pengguna memiliki izin untuk mengeditnya
        if (!$community || $community->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Komunitas tidak ditemukan atau Anda tidak memiliki izin untuk mengeditnya.');
        }

        return view('tamplate.dashboard.menu.edit-komunitas', compact('community'));
    }
    public function editAdmin($slug)
    {
        // Mengambil berita berdasarkan slug
        $communities = Communities::where('slug', $slug)->first();


        return view('tamplate.dashboard.menuadmin.edit-komunitas', compact('communities'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Umum,Kesehatan,Energi,Industri,Pangan',
            'content' => 'required|string',
            // Tidak memvalidasi slug karena akan dihasilkan secara otomatis
            'number' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mengunggah gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public');
        } else {
            $imagePath = null;
        }

        // Generate slug menggunakan nama komunitas yang dihash
        $slug = Str::slug($request->name) . '-' . Str::random(8);

        $imageHashName = null;
        if ($imagePath) {
            $imageHashName = Str::random(40) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public', $imageHashName);
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
        return redirect()->back()->with('success', 'Komunitas berhasil ditambahkan');
    }

    public function updateAdmin(Request $request, $slug)
    {
        // Mengambil komunitas berdasarkan slug
        $community = Communities::where('slug', $slug)->first();

        // Periksa apakah komunitas ditemukan
        if (!$community) {
            return redirect()->back()->with('error', 'Komunitas tidak ditemukan.');
        }

        $request->validate([
            'status' => [
                'required',
                Rule::in(['active', 'inactive', 'verifikasi']) // Hanya menerima nilai 'aktif' atau 'tidak aktif'
            ]
        ]);

        // Update data komunitas
        $community->status = $request->status;

        // Simpan perubahan
        $community->save();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('menuCommunity')->with('success', 'Status komunitas berhasil diperbarui.');
    }
    public function update(Request $request, $slug)
    {
        // Mengambil komunitas berdasarkan slug
        $community = Communities::where('slug', $slug)->first();

        // Periksa apakah komunitas ditemukan
        if (!$community) {
            return redirect()->route('informasi')->with('error', 'Komunitas tidak ditemukan.');
        }

        // Periksa apakah pengguna memiliki izin untuk mengedit komunitas
        if ($community->user_id !== Auth::id()) {
            return redirect()->route('informasi')->with('error', 'Anda tidak memiliki izin untuk mengedit komunitas ini.');
        }

        // Validasi request
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Umum,Kesehatan,Energi,Industri,Pangan',
            'content' => 'required|string',
            'number' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data komunitas
        $community->name = $request->name;
        $community->category = $request->category;
        $community->content = $request->content;
        if (substr($request->number, 0, 1) === '0') {
            $community->number = '62' . substr($request->number, 1);
        } else {
            $community->number = $request->number;
        }

        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($community->image) {
                $imagePath = public_path('images/community') . '/' . $community->image;
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/community'), $imageName);
            $community->image = $imageName;
        }

        // Simpan perubahan
        $community->save();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('komunitas')->with('success', 'Komunitas berhasil diperbarui.');
    }

    public function delete($id)
    {
        $community = Communities::find($id);

        if (!$community || $community->user_id !== Auth::id()) {
            return redirect()->route('informasi')->with('error', 'Komunitas tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.');
        }

        // Menghapus gambar dari folder public/images jika ada
        if ($community->image) {
            $imagePath = public_path('images/community') . '/' . $community->image;

            // Hapus gambar hanya jika file tersebut ada
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Menghapus komunitas dari database
        $community->delete();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Komunitas berhasil dihapus.');
    }
}