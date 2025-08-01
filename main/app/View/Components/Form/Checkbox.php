<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
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
     * @var int
     */
    public $value;

    /**
     * @var bool
     */
    public $checked = false;

    /**
     * Create a new component instance.
     *
     * @param string      $name
     * @param string|null $label
     * @param int         $value
     * @param string|null $bind
     */
    public function __construct(string $name, string $label = null, int $value = 1, string $bind = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;

        $oldData = old($name);

        if (!is_null($oldData)) {
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
        return view('components.form.checkbox');
    }
}
