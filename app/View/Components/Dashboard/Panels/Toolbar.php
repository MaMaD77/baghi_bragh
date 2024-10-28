<?php

namespace App\View\Components\Dashboard\Panels;

use Illuminate\View\Component;

class Toolbar extends Component
{
    public $title;
    public $breadcrumbs;

    /**
     * Create the component instance.
     *
     * @param  string  $pageConfigs
     * @return void
     */
    public function __construct($title = null, $breadcrumbs = null)
    {
        $this->title = $title;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.panels.toolbar');
    }
}
