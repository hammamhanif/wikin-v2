<?php

namespace App\Http\Controllers;

use App\Models\Communities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\RegistrasiCommunities;
use Illuminate\Support\Facades\Storage;

class CommunitiesController extends Controller
{

    public function komunitasPengguna()
    {
        $communities = RegistrasiCommunities::where('user_id', Auth::id())
            ->get();

        return view('tamplate.dashboard.menu.komunitasPengguna', compact('communities'));
    }
    public function daftar()
    {
        $communities = Communities::where('status', 'active')->paginate(6);
        $communities->getCollection()->transform(function ($community) {
            $community->content = substr($community->content, 0, 100);
            return $community;
        });

        return view('tamplate.dashboard.menu.daftarKomunitas', compact('communities'));
    }
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
            'group' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5096',
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
        $community->group = $request->group;
        $community->user_id = Auth::id(); // Mengambil ID user yang sedang login
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

        // Validasi request
        $request->validate([
            'status' => [
                'required',
                Rule::in(['active', 'inactive', 'verifikasi']) // Hanya menerima nilai 'active', 'inactive', atau 'verifikasi'
            ],
            'user_id' => 'required|exists:users,id' // Validasi user_id harus ada di tabel users
        ]);

        // Update data komunitas
        $community->status = $request->status;
        $community->user_id = $request->user_id;

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
            'group' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144',
        ]);

        // Update data komunitas
        $community->name = $request->name;
        $community->category = $request->category;
        $community->content = $request->content;
        $community->group = $request->group;


        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($community->image) {
                Storage::delete('public/' . $community->image);
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public', $imageName);
            $community->image = $imageName;
        }

        // Simpan perubahan
        $community->save();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('komunitas')->with('success', 'Komunitas berhasil diperbarui.');
    }

    public function delete($id)
    {
        // Mengambil komunitas berdasarkan ID
        $community = Communities::find($id);

        // Periksa apakah komunitas ditemukan dan pengguna memiliki izin
        if (!$community || $community->user_id !== Auth::id()) {
            return redirect()->route('informasi')->with('error', 'Komunitas tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.');
        }

        // Menghapus gambar dari storage jika ada
        if ($community->image) {
            $imagePath = 'public/' . $community->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        // Menghapus komunitas dari database
        $community->delete();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Komunitas berhasil dihapus.');
    }
}
