<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NewsAtHomePage extends Component
{
    public $lastNews;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($lastNews)
    {
        $this->lastNews = $lastNews;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.news-at-home-page', [
            'lastNews' => $this->lastNews
        ]);
    }
}
