<?php

namespace App\Http\Livewire\AdminPanel;

use App\Models\Pages;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Livewire\WithPagination;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    
    // Binding Variable
    public $pages;
    public $new_category;
    public $select_page;
    public $delete_id;

    protected $rules = [
        'new_category' => 'required',
    ];

    public function updatedSelectPage () {
        $this->resetPage();
    }

    public function mount() {
        $this->delete_id = null;
        $this->pages = Pages::all();
        $this->select_page = $this->pages->first()->id;
    }
    
    public function render()
    {
        $categories = PostCategory::with('posts')->where('page_id', '=', $this->select_page)->paginate(8);
        return view('livewire.admin-panel.category', ['categories' => $categories])->layout('layouts.admin');
    }

    public function validate_category() {
        $this->validate();
        $this->dispatchBrowserEvent('toggle-add-category-modal');
    }
    
    public function store_category() {
        $post_category = new PostCategory;

        $generator_rules = [
            'table' => 'post_categories',
            'length' => '5',
            'prefix' => $this->select_page,
            'reset_on_prefix_change' => true,
        ];
        $id_generate = IdGenerator::generate($generator_rules);
    
        $post_category->id = $id_generate;
        $post_category->name = ucwords($this->new_category);
        $post_category->name_slug = Str::slug($this->new_category);
        $post_category->page_id = $this->select_page;
        $post_category->save();
        
        $this->dispatchBrowserEvent('toggle-add-category-modal');
        $this->new_category = '';

        $msg = ['success' => 'Kategori ditambahkan'];
        $this->dispatchBrowserEvent('display-message', $msg);
    }

    public function delete_category() {
        $category = PostCategory::find($this->delete_id);
        if ($category) {
            $category->delete();
            $msg = ['success' => 'Kategori dihapus'];
        } else {
            $msg = ['danger' => 'Kategori Gagal dihapus'];
        }
        
        $this->dispatchBrowserEvent('hide-delete-category-modal');
        $this->delete_id = null;
        
        $this->dispatchBrowserEvent('display-message', $msg);
    }
    
    
    
}
