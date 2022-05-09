<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "password" => ["required", "string", "min:8", "current_password"],
            "newPassword" => ["required", "string", "min:8", "confirmed"],
            "newPassword_confirmation" => ["required", "string", "min:8"],
        ];
    }
}
