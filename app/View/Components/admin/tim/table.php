<?php

namespace App\View\Components\admin\tim;

use Closure;
use Faker\Core\Number;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Type\Integer;

class table extends Component
{
    /**
     * Create a new component instance.
     */

    protected $except = ['timId'];

    public function __construct(
        public int $num,
        public string $tim,
        public int $season,
        public int $id,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.tim.table');
    }
}
