<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "password" => ["required", "string", "min:8"],
            "newPassword" => ["required", "string", "min:8", "confirmed"],
            "newPassword_confirmation" => ["required", "string", "min:8"],
        ];
    }
}
