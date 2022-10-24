<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class LoginTwoFaUserCodeRequest extends FormRequest
{
    public function rules(): array
    {
        Session::put("email", $this->request->get("email"));

        return [
            "email" => ["required", "string", "email", "max:255"],
            "code" => ["required", "integer", "numeric", "min:100000", "max:999999"],
        ];
    }
}
