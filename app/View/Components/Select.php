<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public function __construct(public array $array = [], public string $name = '', public string $selected = '')
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
