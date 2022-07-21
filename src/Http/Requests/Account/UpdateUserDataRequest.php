<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Account;

use Blumilk\Meetup\Core\Enums\AvailableGenders;
use Blumilk\Meetup\Core\Http\Requests\Speaker\Rules\AvatarFileRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateUserDataRequest extends FormRequest
{
    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            "email" => ["required", "string", "email", "max:255", "unique:users,email,{$userId},id"],
            "name" => ["required", "string", "max:255"],
            "avatar" => AvatarFileRules::rules(),
            "location" => ["nullable", "string", "max:255"],
            "birthday" => ["nullable", "date"],
            "gender" => ["nullable", new Enum(AvailableGenders::class)],
        ];
    }
}
