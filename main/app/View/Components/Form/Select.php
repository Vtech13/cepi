<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
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
     * @var array
     */
    public $options;

    /**
     * @var string|null
     */
    public $bind;

    /**
     * Create a new component instance.
     *
     * @param string      $name
     * @param string|null $label
     * @param array       $options
     * @param string|null $bind
     */
    public function __construct(string $name, string $label = null, array $options = [], string $bind = null)
    {
//        dump($name);
//        dd($bind);
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->bind = $bind;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
