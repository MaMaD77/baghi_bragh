<?php

namespace App\View\Components\Dashboard\Fields;

use Illuminate\View\Component;

class InputGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string|null $cols = null,
        public string|null $label = null,
        public string|null $addonPrepend = null,
        public string|null $addonAppend = null,
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
        return view('components.dashboard.fields.input-group');
    }
}
