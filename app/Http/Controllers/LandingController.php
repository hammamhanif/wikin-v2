<?php

namespace App\Http\Controllers;

use App\Models\News;
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

        return view('tamplate.landingpage.landingpage', compact('lot_news'));
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
            return $news;
        });

        return view('berita.news', compact('lot_news'));
    }

    public function detail($slug)
    {
        $news = News::whereSlug($slug)->first();
        $news->created = $news->created_at->format('M jS Y');
        return view('berita.news_detail', compact('news'));
    }
}
