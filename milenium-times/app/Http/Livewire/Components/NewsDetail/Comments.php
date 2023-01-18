<?php

namespace App\Http\Livewire\Components\NewsDetail;

use Livewire\Component;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{
    // Constructor Variable
    public $postId;
    
    // Binding Variable
    public $comment;

    protected $rules = [
        'comment' => 'nullable',
    ];

    protected $listeners = [
        'refreshSelf' => '$refresh',
    ];

    public function mount() {
        $this->comment = '';
    }

    public function render()
    {
        $post_comments = PostComment::with([
            'post',
            'user',
        ])->whereHas('post', function($q){
            $q->where('id', '=', $this->postId);
        })->orderBy('created_at', 'desc')->get();     

        return view('livewire.components.news-detail.comments', ['comments' => $post_comments]);
    }

    public function store_comment() {
        $this->validate();
        $new_comment = new PostComment;
        $new_comment->comment = $this->comment;
        $new_comment->post_id = $this->postId;
        $new_comment->user_id = Auth::user()->id;
        $new_comment->save();

        $this->comment = '';
        $this->emit('refreshSelf');
    }


}
