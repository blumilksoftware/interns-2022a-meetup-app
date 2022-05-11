<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class backButton extends Component
{
    public function __construct(
        public $name,
        public $url,
    ) {}

    public function render(): View
    {
        return view("components.back-button");
    }
}
