<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Conversation extends Component
{
    public \App\Models\Conversation $conversation;

    /**
     * Create a new component instance.
     */
    public function __construct(\App\Models\Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.conversation');
    }
}
