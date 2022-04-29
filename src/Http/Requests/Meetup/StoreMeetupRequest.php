<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Meetup;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => ["required"],
            "description" => ["nullable"],
            "date" => ["required"],
            "place" => ["required"],
            "language" => ["required"],
            "logo" => ["image", "max:2048"],
            "organization_id" => ["nullable"],
            "speakers" => ["nullable"],
        ];
    }
}
