<?php

namespace App\Http\Livewire;

use App\Models\Pages;
use Livewire\Component;

class WelcomePage extends Component
{
    // Binding Variable
    public $pages;

    public function mount() {
        $this->pages = Pages::get();
    }

    public function render()
    {
        return view('livewire.welcome-page')->layout('layouts.welcome');
    }
}
