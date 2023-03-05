<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Str;

class SearchBar extends Component
{
    // Constructor Variable
    public $pageId;

    // Binding Variable
    public $search;

    protected $rules = [
        'search' => 'required',
    ];

    public function render()
    {
        return view('livewire.components.search-bar');
    }

    public function input_search() {
        $this->validate();

        if ($this->pageId == 1) {
            return redirect()->route('sport-search')->with('search', $this->search);
        }
        else if ($this->pageId == 2) {
            return redirect()->route('env-search')->with('search', $this->search);
        }
        else if ($this->pageId == 3) {
            return redirect()->route('history-search')->with('search', $this->search);
        }
    }

}
