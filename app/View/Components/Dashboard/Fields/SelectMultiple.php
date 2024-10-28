<?php

namespace App\View\Components\Dashboard\Fields;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectMultiple extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $options,
        public string|null $cols = null,
        public string|null $label = null,
        public array $value = [],
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.fields.select-multiple');
    }
}
