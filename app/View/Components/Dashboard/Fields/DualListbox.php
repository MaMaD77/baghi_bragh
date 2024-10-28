<?php

namespace App\View\Components\Dashboard\Fields;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DualListbox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $options,
        public string $optionText,
        public string $optionValue,
        public string|null $cols = null,
        public string|null $label = null,
        public array $values = [],
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.fields.dual-listbox');
    }
}
