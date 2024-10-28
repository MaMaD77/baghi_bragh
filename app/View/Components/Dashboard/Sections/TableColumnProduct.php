<?php

namespace App\View\Components\Dashboard\Sections;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableColumnProduct extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.sections.table-column-product');
    }
}
