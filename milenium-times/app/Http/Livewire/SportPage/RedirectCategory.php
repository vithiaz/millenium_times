<?php

namespace App\Http\Livewire\SportPage;

use Livewire\Component;

class RedirectCategory extends Component
{
    // Route Binding Variable;
    public $targetSlug;

    public function mount() {
        return redirect()->route('sport-category')->with('slug', $this->targetSlug);
    }

}
