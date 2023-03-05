<?php

namespace App\Http\Livewire\SportPage;

use DOMDocument;
use App\Models\Post;
use App\Models\Pages;
use Livewire\Component;
use Illuminate\Support\Carbon;

class Home extends Component
{
    public $PAGE_ID = 1;
    public $page;
    protected $post_Query;
    protected $posts;

    private $POPULAR_POST_LIMIT = 12;

    // Binding Variable
    public $popular_post_hero;
    public $popular_post;
    
    public function mount() {
        $this->page = Pages::find($this->PAGE_ID);
        $this->post_Query = Post::where('page_id', '=', $this->PAGE_ID)->with(['category']);
        $this->posts = $this->post_Query->orderBy('created_at', 'DESC')->get();

        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
    }

    public function render()
    {
        $newest_post_hero = $this->posts->first();
        $newest_posts = $this->posts->skip(1)->take(3);
        $weeks_popular_posts = $this->post_Query->popularThisWeek()->orderBy('visit_count_total', 'DESC')->take(8)->get();
        
        // Get more Posts for filling Weekly Posts
        $all_time_popular_posts = [];
        if ($weeks_popular_posts->count() <= $this->POPULAR_POST_LIMIT) {
            $existPost = [];
            
            foreach ($weeks_popular_posts as $posted) {
                array_push($existPost, $posted->id);
            }

            $more_post_limit = $this->POPULAR_POST_LIMIT - $weeks_popular_posts->count();
            $all_time_popular_posts = Post::where('page_id', '=', $this->PAGE_ID)->with(['category'])->popularAllTime()->orderBy('visit_count_total', 'DESC')->whereNotIn('id', $existPost)->take($this->POPULAR_POST_LIMIT)->get();
        }
        
        return view('livewire.sport-page.home', [
            'newest_post_hero' => $newest_post_hero,
            'newest_posts' => $newest_posts,
            'weeks_popular_posts' => $weeks_popular_posts,
            'all_time_popular_posts' => $all_time_popular_posts,
            'page_wallpaper' => $this->page->wallpaper_img,
        ])->layout('layouts.sport');
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
