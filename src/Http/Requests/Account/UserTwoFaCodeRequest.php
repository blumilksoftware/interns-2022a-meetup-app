<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UserTwoFaCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "code" => ["required", "integer", "numeric", "min:100000", "max:999999"],
        ];
    }
}
