<?php

namespace App\Http\Livewire\SportPage;

use DOMDocument;
use App\Models\Post;
use Livewire\Component;
use App\Models\PostCategory;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class NewsPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $PAGE_ID = 1;
    protected $post_Query;


    // Binding variable
    public $hero_post;
    public $top_categories;

    public function mount() {
        $this->post_Query = Post::where('page_id', '=', $this->PAGE_ID)->with(['category'])->orderBy('created_at', 'desc');
        $this->hero_post = $this->post_Query->first();
        $this->top_categories = PostCategory::with('posts')->where('page_id', '=', $this->PAGE_ID)->take(7)->get()->sortByDesc('posts');
    }

    public function render()
    {
        $posts = Post::where([
            ['page_id', '=', $this->PAGE_ID],
            ['id', '!=', $this->hero_post->id],
        ])->with(['category'])->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.sport-page.news-page', ['posts' => $posts])->layout('layouts.sport');
    }

    public function to_category($id) {
        return redirect()->route('sport-category')->with('id', $id);
    }


    public function get_first_paragraph($body) {
        $dom = new DOMDocument;
        $dom->loadHTML($body);
        return $dom->getElementsByTagName('p')->item(0)->nodeValue;
    }

    public function translate_date($date, $format='l, j F Y') {
        $date_translate = Carbon::parse($date)->locale(config('app.locale'));
        $date_translate->settings(['formatFunction' => 'translatedFormat']);
        return $date_translate->format($format);
    }
}
