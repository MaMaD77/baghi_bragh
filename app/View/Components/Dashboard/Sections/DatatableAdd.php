<?php

namespace App\View\Components\Dashboard\Sections;

use Illuminate\View\Component;

class DatatableAdd extends Component
{
    public $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.sections.datatable-add');
    }
}
