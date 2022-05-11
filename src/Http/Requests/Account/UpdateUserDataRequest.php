<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Account;

use Blumilk\Meetup\Core\Http\Requests\Speaker\Rules\AvatarFileRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserDataRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => ["required", "string", "email", "max:255",
                Rule::unique("users")->where(fn ($query) => $query->where("email", "!=", Auth::user()->email)), ],
            "name" => ["required", "string", "max:255"],
            "avatar" => AvatarFileRules::rules(),
        ];
    }
}
