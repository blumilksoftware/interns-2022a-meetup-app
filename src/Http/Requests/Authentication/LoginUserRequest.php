<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => ["required", "string", "email", "max:255"],
            "password" => ["required", "string", "min:8"],
        ];
    }
}
