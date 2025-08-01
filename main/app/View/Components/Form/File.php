<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class File extends Component
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
     * @var array|string|string[]
     */
    public $nameArray;

    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string|null
     */
    public $help;

    /**
     * Create a new component instance.
     *
     * @param string      $name
     * @param string|null $label
     * @param string|null $title
     * @param string|null $help
     */
    public function __construct(string $name, string $label = null, string $title = 'Déposez votre fichier', string $help = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->title = $title;
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
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.form.file');
    }
}
