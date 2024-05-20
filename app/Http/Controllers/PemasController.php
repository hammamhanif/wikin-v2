<?php

namespace App\Http\Controllers;

use App\Models\pemas;
use App\Models\FormPemas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

    public function create()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        // Get the currently authenticated user
        $user = Auth::user();
        $pengmases = pemas::where('user_id', $user->id)->get();
        $formPengmases = FormPemas::where('user_id', $user->id)->get();
        return view('tamplate.dashboard.menu.menuPemas', compact('pengmases', 'formPengmases'));
    }
    public function indexAdmin()
    {
        $pengmases = pemas::all();
        $formPengmases = FormPemas::all();
        return view('tamplate.dashboard.menuadmin.menuPemas', compact('pengmases', 'formPengmases'));
    }
    public function edit($slug)
    {
        $pemas = pemas::where('slug', $slug)->first();
        return view('tamplate.dashboard.menu.edit-pemas', compact('pemas'));
    }
    public function editAdmin($slug)
    {
        $pemas = pemas::where('slug', $slug)->first();
        return view('tamplate.dashboard.menuadmin.edit-pemas', compact('pemas'));
    }
    public function editForm($slug)
    {
        $pemas = formPemas::where('slug', $slug)->first();
        return view('tamplate.dashboard.menu.edit-formPemas', compact('pemas'));
    }
    public function editFormAdmin($slug)
    {
        $pemas = formPemas::where('slug', $slug)->first();
        return view('tamplate.dashboard.menuadmin.edit-formPemas', compact('pemas'));
    }
    public function update(Request $request, $slug)
    {
        // Mengambil berita berdasarkan slug
        $pemas = Pemas::where('slug', $slug)->first();

        // Validasi request
        $request->validate([
            'location' => 'required|string|max:255', // Validasi location
            'category' => 'required|string|max:255', // Validasi category
            'name' => 'required|string|max:255', // Validasi category
            'content' => 'required|string', // Validasi content
            'status_pemas' => 'required|in:pengajuan,sedang berjalan,selesai,pencarian volunteer', // Validasi status_pemas
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi image
        ]);

        // Perbarui field dengan nilai baru
        $pemas->location = $request->location;
        $pemas->category = $request->category;
        $pemas->name = $request->name;
        $pemas->content = $request->content;
        $pemas->status_pemas = $request->status_pemas;

        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            // Simpan file gambar dan dapatkan path
            $imagePath = $request->file('image')->store('images', 'public');

            // Hapus gambar lama jika ada
            if ($pemas->image) {
                Storage::disk('public')->delete($pemas->image);
            }

            // Perbarui field image dengan path baru
            $pemas->image = $imagePath;
        }

        // Simpan perubahan ke database
        $pemas->save();

        // Mengembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data pemas berhasil diperbarui.');
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
        return redirect()->back()->with('success', 'Data Pengabdian berhasil diperbarui.');
    }

    public function updateFormAdmin(Request $request, $slug)
    {
        $formPemas =  formPemas::where('slug', $slug)->first();
        // Validasi input
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Proses verifikasi,Diterima,Ditolak',
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Periksa apakah record ada
        if (!$formPemas) {
            return redirect()->back()->with('error', 'Data kegiatan tidak ditemukan.');
        }
        $formPemas->status = $request->status;

        // Menyimpan perubahan ke basis data
        $formPemas->save();

        // Redirect ke halaman atau rute yang diinginkan dengan pesan sukses
        return redirect()->back()->with('success', 'Data kegiatan berhasil diperbarui.');
    }
    public function updateForm(Request $request, $slug)
    {
        $formPemas =  formPemas::where('slug', $slug)->first();
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

        // Periksa apakah record ada
        if (!$formPemas) {
            return redirect()->back()->with('error', 'Data kegiatan tidak ditemukan.');
        }

        // Mengisi properti dari instansi dengan data dari request
        $formPemas->name = auth()->user()->name;
        $formPemas->user_id = auth()->user()->id;
        $formPemas->noID = $request->input('noID');
        $formPemas->nama_kegiatan = $request->input('nama_kegiatan');
        $formPemas->location = $request->input('location');
        $formPemas->start_time = $request->input('start_time');
        $formPemas->end_time = $request->input('end_time');
        $formPemas->category = $request->input('category');
        $formPemas->content = $request->input('content');

        // Menyimpan perubahan ke basis data
        $formPemas->save();

        // Redirect ke halaman atau rute yang diinginkan dengan pesan sukses
        return redirect()->back()->with('success', 'Data kegiatan berhasil diperbarui.');
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

        // Proses penyimpanan pemas
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
            $hashName = Hash::make(time() . $image->getClientOriginalName());
            $imageName = md5($hashName) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
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
        $formPemas->user_id = auth()->user()->id;
        $formPemas->noID = $request->input('noID');
        $formPemas->slug = hash('sha256', $request->input('nama_kegiatan'));
        $formPemas->nama_kegiatan = $request->input('nama_kegiatan');
        $formPemas->location = $request->input('location');
        $formPemas->start_time = $request->input('start_time');
        $formPemas->end_time = $request->input('end_time');
        $formPemas->category = $request->input('category');
        $formPemas->content = $request->input('content');
        $formPemas->status = 'Proses verifikasi'; // Menambahkan status default

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

    public function destroy($id)
    {
        // Cari pemas berdasarkan ID
        $pemas = pemas::findOrFail($id);

        // Otorisasi: Pastikan hanya pemilik yang bisa menghapus data ini
        if (auth()->user()->id !== $pemas->user_id) {
            return redirect()->route('pemas')->with('error', 'Anda tidak memiliki izin untuk menghapus data ini');
        }

        // Hapus gambar jika ada
        if ($pemas->image) {
            Storage::disk('public')->delete('images/' . $pemas->image);
        }

        // Hapus data pemas
        $pemas->delete();

        return redirect()->route('pemasSetting')->with('success', 'Data berhasil dihapus!');
    }

    public function destroyForm($id)
    {
        // Find the record by ID
        $formPemas = FormPemas::find($id);

        // Check if the record exists
        if (!$formPemas) {
            return redirect()->back()->with('error', 'Data kegiatan tidak ditemukan.');
        }

        // Delete the record
        $formPemas->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
