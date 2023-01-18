<?php

namespace App\Http\Livewire\SportPage;

use Livewire\Component;

class Gallery extends Component
{
    public function render()
    {
        return view('livewire.sport-page.gallery')->layout('layouts.sport');
    }
}
