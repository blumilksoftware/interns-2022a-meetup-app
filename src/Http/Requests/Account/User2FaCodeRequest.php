<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class User2FaCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "code" => ["required", "string", "numeric", "max:999999"],
        ];
    }
}
