<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;


class Card extends Component
{
    public $post;
    public function __construct($post)
    {
        $this->post = $post;
    }

    public function trimmer($text, $limit=20) {
        return Str::limit($text, $limit);
    }
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
