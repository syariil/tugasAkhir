<?php

namespace App\View\Components\admin\schedule;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class table extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $num,
        public int $id,
        public string $tima,
        public string $timb,
        public int $scorea,
        public int $scoreb,
        public string $time,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.schedule.table');
    }
}
