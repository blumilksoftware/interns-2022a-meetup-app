<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class BackButton extends Component
{
    public function __construct(
        public string $name,
        public string $url,
    ) {}

    public function render(): View
    {
        return view("components.back-button");
    }
}
