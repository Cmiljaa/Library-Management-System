<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    public function __construct(
        public string $type = 'text',
        public string $name = '',
        public string $id = '',
        public string $value = '',
        public string $placeholder = '',
        public bool $required = false
    )
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
