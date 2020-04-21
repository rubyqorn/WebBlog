<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LastFiveNewsAtHomePage extends Component
{
    public $news;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($news)
    {
        $this->news = $news;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.last-five-news-at-home-page', [
            'news' => $this->news
        ]);
    }
}
