<?php

namespace App\Http\Livewire\HistoryPage;

use Livewire\Component;

class RedirectCategory extends Component
{
    // Route Binding Variable;
    public $targetSlug;

    public function mount() {
        return redirect()->route('history-category')->with('slug', $this->targetSlug);
    }
}
