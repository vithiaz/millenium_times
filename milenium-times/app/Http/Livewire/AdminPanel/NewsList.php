<?php

namespace App\Http\Livewire\AdminPanel;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Pages;
use Livewire\Component;
use Livewire\WithPagination;

class NewsList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Binding Variable
    public $pages;
    public $select_page;
    

    public function updatedSelectPage () {
        $this->resetPage();
    }

    public function mount() {
        $this->pages = Pages::all();
        // dd($this->pages);
        $this->select_page = $this->pages->first()->id;
        
    }
    
    public function render()
    {
        $posts = Post::with(['category', 'user'])->where('page_id', '=', $this->select_page)->paginate(8);
        return view('livewire.admin-panel.news-list', ['posts' => $posts])->layout('layouts.admin');
    }
}
