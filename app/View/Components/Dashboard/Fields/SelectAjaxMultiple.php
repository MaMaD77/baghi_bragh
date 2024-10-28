<?php

namespace App\View\Components\Dashboard\Fields;

use Illuminate\View\Component;

class SelectAjaxMultiple extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $optionText = 'item.name',
        public string $optionValue = 'item.id',
        public string|null $cols = null,
        public string|null $label = null,
        public string|null $labelToolbar = null,
        public array $value = [],
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.fields.select-ajax-multiple');
    }
}
