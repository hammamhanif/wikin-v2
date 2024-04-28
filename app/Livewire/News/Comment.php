<?php

namespace App\Livewire\News;

use App\Models\Like;
use App\Models\News;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment as ModelsComment;

class Comment extends Component
{
    public $body, $body2, $news;
    public $comment_id, $edit_comment_id;

    public function mount($id)
    {
        $this->news = News::find($id);
    }
    public function render()
    {
        return view('livewire.news.comment', [
            'comments' => ModelsComment::with(['user', 'childrens'])
                ->where('news_id', $this->news->id)
                ->whereNull('comment_id')->get(),
            'total_comments' => ModelsComment::where('news_id', $this->news->id)->count(),
        ]);
    }

    public function store()
    {
        $this->validate(['body' => 'required']);
        $comment = ModelsComment::create([
            'user_id' => Auth::user()->id,
            'news_id' => $this->news->id,
            'body' => $this->body
        ]);
        if ($comment) {
            // $this->emit('comment_stored', $comment->id); 
            $this->body = null;
        } else {
            session()->flash('danger', 'Komentar diskusi gagal dibuat!');
            return redirect()->route('detail', $this->news->slug);
        }
    }

    public function reply()
    {
        $this->validate(['body2' => 'required']);
        $comment = ModelsComment::find($this->comment_id);
        $comment = ModelsComment::create([
            'user_id' => Auth::user()->id,
            'news_id' => $this->news->id,
            'body' => $this->body2,
            'comment_id' => $comment->comment_id ? $comment->comment_id : $comment->id
        ]);
        if ($comment) {
            // $this->emit('comment_stored', $comment->id); 
            $this->body2 = NULL;
            $this->comment_id = NULL;
        } else {
            session()->flash('danger', 'Komentar diskusi gagal dibuat!');
            return redirect()->route('detail', $this->news->slug);
        }
    }

    public function selectReply($id)
    {
        $this->comment_id = $id;
        $this->edit_comment_id = NULL;
        $this->body2 = NULL;
    }

    public function selectEdit($id)
    {
        $comment = ModelsComment::find($id);
        $this->edit_comment_id = $comment->id;
        $this->body2 = $comment->body;
        $this->comment_id = NULL;
    }

    public function change()
    {
        $this->validate(['body2' => 'required']);
        $comment = ModelsComment::where('id', $this->edit_comment_id)->update([
            'body' => $this->body2
        ]);
        if ($comment) {
            // $this->emit('comment_stored', $comment->id); 
            $this->body = null;
            $this->edit_comment_id = null;
        } else {
            session()->flash('danger', 'Komentar diskusi gagal diubah!');
            return redirect()->route('detail', $this->news->slug);
        }
    }
    public function delete($id)
    {
        $comment = ModelsComment::where('id', $id)->delete();
        if ($comment) {
            // $this->emit('comment_stored', $comment->id); 
            return NULL;
        } else {
            session()->flash('danger', 'Komentar diskusi gagal dihapus!');
            return redirect()->route('detail', $this->news->slug);
        }
    }

    public function like($id)
    {
        $data = [
            'comment_id' => $id,
            'user_id' => Auth::user()->id
        ];

        $like = Like::where($data);
        if ($like->count() > 0) {
            $like->delete();
        } else {
            Like::create($data);
        }
        return NULL;
    }
}
