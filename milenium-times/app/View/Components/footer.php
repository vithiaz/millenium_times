<?php

namespace App\View\Components;

use Illuminate\View\Component;

class footer extends Component
{

    public $pages;
    
    public function __construct($pages)
    {
        $this->pages = $pages;
    }

   
    public function render()
    {
        return view('components.footer');
    }
}
