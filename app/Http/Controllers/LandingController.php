<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\pemas;
use App\Models\Communities;
use Illuminate\Http\Request;

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
        $pemases = pemas::with('user')
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


        return view('tamplate.landingpage.landingpage', compact('lot_news', 'pemases'),);
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
            $news->content = substr($news->content, 0, 200);
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

        $pengmases = pemas::join('users', 'pemas.user_id', '=', 'users.id')
            ->where('pemas.status', 'Diterima')
            ->where(function ($query) use ($searchQuery) {
                $query->where('pemas.name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('pemas.category', 'like', '%' . $searchQuery . '%')
                    ->orWhere('pemas.status_pemas', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.username', 'like', '%' . $searchQuery . '%')
                    ->orWhere('pemas.location', 'like', '%' . $searchQuery . '%');
            })
            ->orderByDesc('pemas.updated_at')
            ->select('pemas.*', 'users.username as author')
            ->paginate(6);


        $pengmases->getCollection()->transform(function ($pemas) {
            $pemas->created = $pemas->created_at->format('M jS Y');
            $pemas->total_comments = $pemas->comments->count();
            $pemas->content = substr($pemas->content, 0, 200);
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
            $community->content = substr($community->content, 0, 200);
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
}
