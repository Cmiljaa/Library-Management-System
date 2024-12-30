<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class RoleAccess extends Component
{
    public array $roles;

    public function __construct($roles)
    {
        $this->roles = $roles;
    }

    public function render(): View|Closure|string
    {
        return view('components.role-access', ['roleAccess' => Auth::check() && in_array(Auth::user()->role, $this->roles)]);
    }
}
