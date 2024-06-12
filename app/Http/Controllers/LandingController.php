<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\pemas;
use App\Models\landing;
use App\Models\Communities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    public function index()
    {
        $lot_news = News::with('user')->where('status', 'Active')->orderByDesc('updated_at')->get()->take(3)->map(function ($news) {
            $news->created = $news->created_at->format('M jS Y');
            $news->content = substr($news->content, 0, 200);
            $news->author = $news->user->username;
            return $news;
        });
        $lot_news_count = $lot_news->count();

        $pemases = Pemas::with('user')
            ->where('status', 'Diterima')
            ->orderByDesc('updated_at')
            ->get()
            ->take(3)
            ->map(function ($pemas) {
                $pemas->created = $pemas->created_at->format('M jS Y');
                $pemas->content = substr($pemas->content, 0, 200);
                $pemas->author = $pemas->user->username;
                return $pemas;
            });
        $pemases_count = $pemases->count();

        $communities = Communities::with('user')
            ->where('status', 'Active')
            ->orderByDesc('updated_at')
            ->get()
            ->take(3)
            ->map(function ($community) {
                $community->created = $community->created_at->format('M jS Y');
                $community->content = substr($community->content, 0, 200);
                $community->author = $community->user->username;
                return $community;
            });
        $communities_count = $communities->count();

        $landing = Landing::where('id', 1)->firstOrFail();

        return view('tamplate.landingpage.landingpage', compact('lot_news', 'pemases', 'landing', 'lot_news_count', 'pemases_count', 'communities', 'communities_count'));
    }


    public function details(Request $request)
    {
        $searchQuery = $request->input('title');

        $lot_news = News::join('users', 'news.user_id', '=', 'users.id')
            ->where('news.status', 'active')
            ->where(function ($query) use ($searchQuery) {
                $query->where('news.title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('news.category', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.username', 'like', '%' . $searchQuery . '%');
            })
            ->orderByDesc('news.updated_at')
            ->select('news.*', 'users.username as author')
            ->paginate(6);

        $lot_news->getCollection()->transform(function ($news) {
            $news->created = $news->created_at->format('M jS Y');
            $news->content = substr($news->content, 0, 150);
            $news->total_comments = $news->comments->count(); // Mengambil total komentar
            return $news;
        });

        return view('berita.news', compact('lot_news'));
    }

    public function detail($slug)
    {
        $news = News::whereSlug($slug)->first();

        if ($news && $news->status === 'active') {
            $news->created = $news->created_at->format('M jS Y');
            $news->total_comments = $news->comments->count(); // Mengambil total komentar
            return view('berita.news_detail', compact('news'));
        } else {
            abort(404); // Menampilkan halaman 404 jika status tidak 'Diterima' atau berita tidak ditemukan
        }
    }
    public function detailspemas(Request $request)
    {
        $searchQuery = $request->input('name');

        $pengmases = Pemas::join('users', 'pemas.user_id', '=', 'users.id')
            ->join('form_pemas', 'pemas.form_pemas_id', '=', 'form_pemas.id') // tambahkan join ke tabel formpemas
            ->where('pemas.status', 'Diterima')
            ->where(function ($query) use ($searchQuery) {
                $query->where('form_pemas.name', 'like', '%' . $searchQuery . '%') // ubah pemas.name menjadi formpemas.name
                    ->orWhere('form_pemas.category', 'like', '%' . $searchQuery . '%')
                    ->orWhere('pemas.status_pemas', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.username', 'like', '%' . $searchQuery . '%')
                    ->orWhere('form_pemas.location', 'like', '%' . $searchQuery . '%');
            })
            ->orderByDesc('pemas.updated_at')
            ->select('pemas.*', 'users.username as author')
            ->paginate(6);


        $pengmases->getCollection()->transform(function ($pemas) {
            $pemas->created = $pemas->created_at->format('M jS Y');
            $pemas->total_comments = $pemas->comments->count();
            $pemas->content = substr($pemas->content, 0, 100);
            return $pemas;
        });

        return view('pemas.pengmases', compact('pengmases'));
    }



    public function detailpemas($slug)
    {
        $pemas = pemas::whereSlug($slug)->first();

        if ($pemas && $pemas->status === 'Diterima') {
            $pemas->created = $pemas->created_at->format('M jS Y');
            $pemas->total_comments = $pemas->comments->count();
            return view('pemas.pemas_detail', compact('pemas'));
        } else {
            abort(404);
        }
    }

    public function detailsCommunities(Request $request)
    {
        $searchQuery = $request->input('name');

        $communities = Communities::where('status', 'active') // Mengambil hanya komunitas dengan status 'active'
            ->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('category', 'like', '%' . $searchQuery . '%')
                    ->orWhere('status', 'like', '%' . $searchQuery . '%')
                    ->orWhere('content', 'like', '%' . $searchQuery . '%') // Menambahkan pencarian berdasarkan 'content'
                    ->orWhereHas('user', function ($query) use ($searchQuery) {
                        $query->where('username', 'like', '%' . $searchQuery . '%');
                    });
            })
            ->orderByDesc('updated_at')
            ->with('user') // Mengambil relasi user
            ->paginate(6);

        $communities->getCollection()->transform(function ($community) {
            $community->created = $community->created_at->format('M jS Y');
            $community->content = substr($community->content, 0, 150);
            return $community;
        });

        return view('komunitas.communities', compact('communities'));
    }

    public function detailcommunity($slug)
    {
        $community = Communities::whereSlug($slug)->first();

        if ($community && $community->status === 'active') {
            $community->created = $community->created_at->format('M jS Y');
            return view('komunitas.communityDetail', compact('community'));
        } else {
            abort(404);
        }
    }


    // pengaturan landing page
    public function menu()
    {
        $landings = Landing::all(); // Mengambil data dengan ID 1
        return view('tamplate.dashboard.menuadmin.menuLanding', compact('landings'));
    }
    public function menuUpdate($id)
    {
        $landing = Landing::findOrFail($id);
        return view('tamplate.dashboard.menuadmin.editLanding', compact('landing'));
    }

    public function store(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'video' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20000',
            'location' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'question1' => 'nullable|string|max:255',
            'answer1' => 'nullable|string',
            'question2' => 'nullable|string|max:255',
            'answer2' => 'nullable|string',
            'question3' => 'nullable|string|max:255',
            'answer3' => 'nullable|string',
            'question4' => 'nullable|string|max:255',
            'answer4' => 'nullable|string',
            'question5' => 'nullable|string|max:255',
            'answer5' => 'nullable|string',
            'youtube1' => 'nullable|string|max:255',
            'youtube2' => 'nullable|string|max:255',
        ]);

        // Cari data landing berdasarkan ID
        $landing = Landing::find($id);

        if ($landing) {
            // Hapus video lama jika ada
            if ($landing->video && $request->hasFile('video')) {
                Storage::disk('public')->delete($landing->video);
            }

            // Update data jika ditemukan
            // Upload video jika ada
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('videos', $filename, 'public');
                $validatedData['video'] = $filePath;
            }

            $landing->update($validatedData);

            // Redirect atau berikan respon sesuai kebutuhan
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } else {
            // Buat data baru jika tidak ditemukan
            // Upload video jika ada
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('videos', $filename, 'public');
                $validatedData['video'] = $filePath;
            }

            Landing::create($validatedData);

            // Redirect atau berikan respon sesuai kebutuhan
            return redirect()->back()->with('success', 'Data baru berhasil dibuat.');
        }
    }
}
