<?php

namespace App\View\Components\Dashboard\Sections;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DatatableFilterButton extends Component
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
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.sections.datatable-filter-button');
    }
}
