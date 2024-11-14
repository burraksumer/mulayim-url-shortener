<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CharCounter extends Component
{
    public $maxChars;

    public function __construct($maxChars = 10)
    {
        $this->maxChars = $maxChars;
    }

    public function render()
    {
        return view('components.char-counter');
    }
}