<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\pemas;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $lot_news = News::with('user')->orderByDesc('updated_at')->get()->take(3)->map(function ($news) {
            $news->created = $news->created_at->format('M jS Y');
            $news->content = substr($news->content, 0, 200);
            $news->author = $news->user->username;
            return $news;
        });
        $pemases = pemas::with('user')->orderByDesc('updated_at')->get()->take(3)->map(function ($pemas) {
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
        $news->created = $news->created_at->format('M jS Y');
        $news->total_comments = $news->comments->count(); // Mengambil total komentar
        return view('berita.news_detail', compact('news'));
    }
    public function detailspemas(Request $request)
    {
        $searchQuery = $request->input('name');

        $pengmases = pemas::join('users', 'pemas.user_id', '=', 'users.id')
            ->where(function ($query) use ($searchQuery) {
                $query->where('pemas.name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('pemas.category', 'like', '%' . $searchQuery . '%')
                    ->orWhere('users.username', 'like', '%' . $searchQuery . '%')
                    ->orWhere('pemas.location', 'like', '%' . $searchQuery . '%')
                    ->orWhere('pemas.status', 'like', '%' . $searchQuery . '%');
            })
            ->orderByDesc('pemas.updated_at')
            ->select('pemas.*', 'users.username as author')
            ->paginate(6);

        $pengmases->getCollection()->transform(function ($pemas) {
            $pemas->created = $pemas->created_at->format('M jS Y');
            $pemas->content = substr($pemas->content, 0, 200);
            return $pemas;
        });

        return view('pemas.pengmases', compact('pengmases'));
    }



    public function detailpemas($slug)
    {
        $pemas = pemas::whereSlug($slug)->first();
        $pemas->created = $pemas->created_at->format('M jS Y');
        return view('pemas.pemas_detail', compact('pemas'));
    }
}
