<?php

namespace App\Http\Livewire\Components\Home;

use App\Models\Post;
use Livewire\Component;

class MostViewPosts extends Component
{
    // Constructor Variable;
    public $pageId;

    // Binding Variable
    public $most_view_posts;

    public function mount() {
        $this->most_view_posts = Post::where('page_id', '=', $this->pageId)->popularAllTime()->take(5)->get();
    }

    public function render()
    {
        return view('livewire.components.home.most-view-posts');
    }
}
