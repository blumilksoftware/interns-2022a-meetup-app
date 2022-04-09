<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "token" => ["required"],
            "email" => ["required", "string", "email"],
            "password" => ["required", "string", "min:8", "confirmed"],
            "password_confirmation" => ["required", "string", "min:8"],
        ];
    }
}
