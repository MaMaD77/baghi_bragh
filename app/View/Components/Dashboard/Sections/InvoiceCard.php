<?php

namespace App\View\Components\Dashboard\Sections;

use Illuminate\View\Component;

class InvoiceCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $printId = 'default', public string $bodyClass = 'px-0')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.sections.invoice-card');
    }
}
