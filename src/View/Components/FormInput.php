<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $id;
    public $name;
    public $type;
    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $name, $type, $value)
    {
        //
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("components.form-input");
    }
}
