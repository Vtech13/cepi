<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * @var string|null
     */
    public $active;

    /**
     * Create a new component instance.
     *
     * @param string|null $active
     */
    public function __construct(string $active = null)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
