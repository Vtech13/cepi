<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Section extends Component
{
    /**
     * @var string
     */
    public $class;

    /**
     * @var string
     */
    public $classContainer = 'container';

    /**
     * Create a new component instance.
     *
     * @param int|null  $top
     * @param bool|null $fluid
     */
    public function __construct(int $top = null, bool $fluid = null)
    {
        if (!is_null($top)) {
            $this->class = 'section__pad-t-' . $top;
        }

        if ($fluid) {
            $this->classContainer = 'container-fluid';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.section');
    }
}
