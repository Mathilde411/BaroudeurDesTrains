<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $label;
    public string $name;
    public string $type;
    public ?string $value;

    /**
     * Create a new component instance.
     */
    public function __construct(string $label, string $name, string $type, string $value=null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
