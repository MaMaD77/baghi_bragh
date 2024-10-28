<?php

namespace App\View\Components\Dashboard\Fields;

use Illuminate\View\Component;

class Radio extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string|null $cols = null,
        public string|null $label = null,
        public string|null $subLabel = null,
        public string|null $imageUrl = null,
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
        return view('components.dashboard.fields.radio');
    }
}
