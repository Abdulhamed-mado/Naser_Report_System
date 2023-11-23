<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class addUser extends Component
{
    public $loaded;
    /**
     * Create a new component instance.
     */
    public function __construct($loaded)
    {
        $this->loaded=$loaded;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.add-user');
    }
}
