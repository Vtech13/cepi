<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $placeholder;

    /**
     * @var string
     */
    public $bind;

    /**
     * If input name is array
     * @var string|string[]
     */
    public $nameArray;

    /**
     * @var string|null
     */
    public $help;

    /**
     * Create a new component instance.
     * @param string      $name
     * @param string      $type
     * @param string|null $label
     * @param string|null $placeholder
     * @param string|null $bind
     * @param string|null $help
     */
    public function __construct(string $name, string $type = 'text', string $label = null, string $placeholder = null, string $bind = null, string $help = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->bind = $bind;
        $this->help = $help;

        if (strpos($name, '[') !== false) {
            $this->nameArray = str_replace(['[', ']'], ['.', ''], $name);
        } else {
            $this->nameArray = $name;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
