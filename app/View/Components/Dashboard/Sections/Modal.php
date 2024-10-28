<?php

namespace App\View\Components\Dashboard\Sections;

use Illuminate\View\Component;

class Modal extends Component
{
    public $id;
    public $title;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title = null, $class = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.sections.modal');
    }
}
