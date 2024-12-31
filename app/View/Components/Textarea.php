<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    
    public function __construct(
        public string $name = '',
        public string $id = '',
        public string $placeholder = '',
        public bool $required = false
    )
    {
        //
    }

    
    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}
