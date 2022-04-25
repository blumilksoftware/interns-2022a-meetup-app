<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class FormInput extends Component
{
    public function __construct(
        public $id,
        public $label,
        public $field,
        public $placeholder,
        public $type,
        public $value,
    ) {} 

    public function render(): View
    {
        return view("components.form-input");
    }
}
