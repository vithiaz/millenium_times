<?php

namespace App\Http\Livewire\EnvPage;

use Livewire\Component;

class RedirectCategory extends Component
{
    // Route Binding Variable;
    public $targetSlug;

    public function mount() {
        return redirect()->route('env-category')->with('slug', $this->targetSlug);
    }
}
