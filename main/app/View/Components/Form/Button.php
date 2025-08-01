<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * @var string
     */
    public $type;

    /**
     * Create a new component instance.
     *
     * @param string $type
     */
    public function __construct(string $type = 'submit')
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.form.button');
    }
}
