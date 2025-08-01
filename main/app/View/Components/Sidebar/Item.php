<?php

namespace App\View\Components\Sidebar;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string|null
     */
    public $icon;

    /**
     * @var string|null
     */
    public $link;

    /**
     * @var bool
     */
    public $active;

    /**
     * Create a new component instance.
     *
     * @param string      $name
     * @param string|null $icon
     * @param string|null $link
     * @param bool        $active
     */
    public function __construct(string $name, string $icon = null, string $link = null, bool $active = false)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->link = $link;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.sidebar.item');
    }
}
