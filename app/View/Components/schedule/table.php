<?php

namespace App\View\Components\schedule;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class table extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $team,
        public string $point,
        public string $win,
        public string $lose,
        public string $wr,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schedule.table');
    }
}
