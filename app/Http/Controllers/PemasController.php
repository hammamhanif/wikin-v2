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
use Symfony\Component\HttpFoundation\Response;

class PemasController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $formPengmases = FormPemas::where('user_id', $user->id)
            ->where('status', 'Diterima')
            ->get();
        return view('pemas.postingPemas', compact('formPengmases'));
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
        $pemas = Pemas::where('slug', $slug)->firstOrFail();

        // Validasi form
        $request->validate([
            'category' => 'required|in:Umum,Kesehatan,Energi,Industri,Pangan',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6144', // Tambahkan validasi untuk tipe gambar dan ukuran maksimum
            'lpj' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Validasi untuk LPJ
        ]);

        // Perbarui properti pemas dengan data dari request

        $pemas->category = $request->input('category');
        $pemas->status_pemas = $request->input('status_pemas');
        $pemas->content = $request->input('content');

        if ($pemas->slug !== hash('sha256', $request->input('name') . time())) {
            $pemas->slug = hash('sha256', $request->input('name') . time());
        }

        $pemas->status = 'Diterima';

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($pemas->image) {
                Storage::disk('public')->delete('images/' . $pemas->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $pemas->image = $imageName;
        }

        // Proses upload LPJ jika ada
        if ($request->hasFile('lpj')) {
            // Hapus LPJ lama jika ada
            if ($pemas->lpj) {
                Storage::disk('public')->delete('lpj/' . $pemas->lpj);
            }
            $lpj = $request->file('lpj');
            $lpjName = time() . '_' . $lpj->getClientOriginalName();
            $lpjPath = $lpj->storeAs('lpj', $lpjName, 'public');
            $pemas->lpj = $lpjName;
        }

        $pemas->user_id = auth()->user()->id;
        $pemas->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui! Silakan cek menu pengabdian.');
    }

    public function updateAdmin(Request $request, $slug)
    {
        // Mengambil berita berdasarkan slug
        // Mengambil berita berdasarkan slug
        $pemas = pemas::where('slug', $slug)->first();

        // Validasi request
        $request->validate([
            'status' => 'required|in:Proses verifikasi,Diterima,Ditolak', // Validasi status
            'user_id' => 'required|exists:users,id' // Validasi user_id, memastikan user_id ada di tabel users
        ]);

        // Mengupdate status dan user_id
        $pemas->status = $request->status;
        $pemas->user_id = $request->user_id;
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
            'user_id' => 'required|exists:users,id' // Validasi user_id, memastikan user_id ada di tabel users
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Periksa apakah record ada
        if (!$formPemas) {
            return redirect()->back()->with('error', 'Data kegiatan tidak ditemukan.');
        }
        $formPemas->user_id = $request->user_id;
        $formPemas->status = $request->status;

        // Menyimpan perubahan ke basis data
        $formPemas->save();

        // Redirect ke halaman atau rute yang diinginkan dengan pesan sukses
        return redirect()->back()->with('success', 'Data kegiatan berhasil diperbarui.');
    }
    public function updateForm(Request $request, $slug)
    {
        $formPemas = FormPemas::where('slug', $slug)->first();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'noID' => 'nullable|string',
            'name' => 'required|string',
            'location' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => ['required', 'date', 'after_or_equal:start_time'],
            'category' => 'required|string',
            'content' => 'required|string',
            'proposal' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Validasi untuk proposal
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

        $formPemas->user_id = auth()->user()->id;
        $formPemas->noID = $request->input('noID');
        $formPemas->name = $request->input('name');
        $formPemas->location = $request->input('location');
        $formPemas->start_time = $request->input('start_time');
        $formPemas->end_time = $request->input('end_time');
        $formPemas->category = $request->input('category');
        $formPemas->content = $request->input('content');

        // Proses upload proposal jika ada
        if ($request->hasFile('proposal')) {
            // Hapus file proposal lama jika ada
            if ($formPemas->proposal && Storage::disk('public')->exists('proposals/' . $formPemas->proposal)) {
                Storage::disk('public')->delete('proposals/' . $formPemas->proposal);
            }

            // Unggah file proposal baru
            $proposal = $request->file('proposal');
            $proposalName = time() . '_' . $proposal->getClientOriginalName();
            $proposalPath = $proposal->storeAs('proposals', $proposalName, 'public');
            $formPemas->proposal = $proposalName;
        }

        // Menyimpan perubahan ke basis data
        $formPemas->save();

        // Redirect ke halaman atau rute yang diinginkan dengan pesan sukses
        return redirect()->back()->with('success', 'Data kegiatan berhasil diperbarui.');
    }



    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'form_pemas_id' => 'required|unique:pemas,form_pemas_id', // Unique validation
            'category' => 'required|in:Umum,Kesehatan,Energi,Industri,Pangan',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:6144', // Tambahkan validasi untuk tipe gambar dan ukuran maksimum
            'lpj' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Validasi untuk LPJ
        ]);
        $user = Auth::user();
        // Proses penyimpanan pemas
        $pemas = new Pemas();
        $pemas->user_id = $user->id;
        $pemas->form_pemas_id = $request->input('form_pemas_id');
        $pemas->category = $request->input('category');
        $pemas->status = $request->input('status');
        $pemas->content = $request->input('content');

        // Menggunakan kombinasi location dan timestamp untuk membuat slug
        $slug = hash('sha256', $request->input('category') . time());
        $pemas->slug = $slug;

        $pemas->status = 'Proses Verifikasi';

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $hashName = Hash::make(time() . $image->getClientOriginalName());
            $imageName = md5($hashName) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $pemas->image = $imageName;
        }

        // Proses upload LPJ jika ada
        if ($request->hasFile('lpj')) {
            $lpj = $request->file('lpj');
            $lpjName = time() . '_' . $lpj->getClientOriginalName();
            $lpjPath = $lpj->storeAs('lpj', $lpjName, 'public');
            $pemas->lpj = $lpjName;
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
            'name' => 'required|string',
            'location' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => ['required', 'date', 'after_or_equal:start_time'],
            'category' => 'required|string',
            'content' => 'required|string',
            'proposal' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Validasi untuk proposal
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat instansi baru dari model FormPemas
        $formPemas = new FormPemas();

        // Mengisi properti dari instansi dengan data dari request
        $formPemas->user_id = auth()->user()->id;
        $formPemas->noID = $request->input('noID');

        $formPemas->name = $request->input('name');
        $formPemas->location = $request->input('location');
        $formPemas->start_time = $request->input('start_time');
        $formPemas->end_time = $request->input('end_time');
        $formPemas->category = $request->input('category');
        $slug = hash('sha256', $request->input('name') . time());
        $formPemas->slug = $slug;
        $formPemas->content = $request->input('content');
        $formPemas->status = 'Proses verifikasi'; // Menambahkan status default

        // Proses upload proposal jika ada
        if ($request->hasFile('proposal')) {
            $proposal = $request->file('proposal');
            $proposalName = time() . '_' . $proposal->getClientOriginalName();
            $proposalPath = $proposal->storeAs('proposals', $proposalName, 'public');
            $formPemas->proposal = $proposalName;
        }

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

        // Hapus file proposal jika ada
        if ($formPemas->proposal && Storage::disk('public')->exists('proposals/' . $formPemas->proposal)) {
            Storage::disk('public')->delete('proposals/' . $formPemas->proposal);
        }

        // Delete the record
        $formPemas->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
