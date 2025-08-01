<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string|null
     */
    public $label;

    /**
     * @var string|null
     */
    public $placeholder;

    /**
     * @var string|null
     */
    public $bind;

    /**
     * @var bool
     */
    public $count;

    /**
     * @var string|null
     */
    public $fluid;

    /**
     * Create a new component instance.
     *
     * @param string      $name
     * @param string|null $label
     * @param string|null $placeholder
     * @param string|null $bind
     * @param int|null    $count
     * @param string|null $fluid
     */
    public function __construct(string $name, string $label = null, string $placeholder = null, string $bind = null, int $count = null, string $fluid = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->bind = $bind;
        $this->count = $count;
        $this->fluid = $fluid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.form.textarea');
    }
}
