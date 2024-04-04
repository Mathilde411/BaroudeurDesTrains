<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoginForm extends Component
{
    public string $cerbairLink;

    /**
     * Create a new component instance.
     */
    public function __construct(string $cerbairLink)
    {
        $this->cerbairLink = $cerbairLink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.login-form');
    }
}
