<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Radio extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

    /**
     * @var string|null
     */
    public $label;

    /**
     * @var bool
     */
    public $checked = false;

    /**
     * @var bool
     */
    public $inline;

    /**
     * Create a new component instance.
     *
     * @param string      $name
     * @param string      $value
     * @param string|null $label
     * @param string|null $bind
     * @param bool        $inline
     */
    public function __construct(string $name, string $value, string $label = null, string $bind = null, bool $inline = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->inline = $inline;

        if (old($name)) {
            $this->checked = old($name) == $value;
        } else {
            if (!empty($bind)) {
                $this->checked = $bind == $value;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.form.radio');
    }
}
