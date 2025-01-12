<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Star extends Component
{
    
    public function __construct(public float $number = 0, public $interactive = false)
    {
        //
    }

    
    public function render(): View|Closure|string
    {
        return view('components.star');
    }
}
