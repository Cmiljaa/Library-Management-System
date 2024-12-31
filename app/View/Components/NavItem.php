<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavItem extends Component
{
    public function __construct(public $href = '')
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.nav-item');
    }
}
