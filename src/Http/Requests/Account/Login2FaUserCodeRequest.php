<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class Login2FaUserCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => ["required", "string", "email", "max:255"],
            "code" => ["required", "string", "numeric", "max:999999"],
        ];
    }
}
