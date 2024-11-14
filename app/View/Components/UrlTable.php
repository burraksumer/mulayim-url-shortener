<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UrlTable extends Component
{
    public $urls;

    public function __construct($urls)
    {
        $this->urls = $urls;
    }

    public function render()
    {
        return view('components.url-table');
    }
}
