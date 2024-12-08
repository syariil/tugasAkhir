<?php

namespace App\View\Components\schedule;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class play extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $teamA,
        public string $teamB,
        public string $logoA,
        public string $logoB,
        public string $scoreA,
        public string $scoreB,
        public string $time,
        public string $date,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schedule.play');
    }
}
