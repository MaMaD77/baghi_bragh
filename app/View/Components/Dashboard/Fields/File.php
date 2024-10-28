<?php

namespace App\View\Components\Dashboard\Fields;

use Illuminate\View\Component;

class File extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $cols,
        public string $label,
        public array $urls = []
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
        return view('components.dashboard.fields.file');
    }
}
