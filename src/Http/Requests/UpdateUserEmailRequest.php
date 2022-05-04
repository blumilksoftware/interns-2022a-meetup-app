<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => ["required", "string", "email", "max:255", "unique:users"],
        ];
    }
}
