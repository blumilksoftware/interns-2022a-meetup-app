<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Invitations;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvitationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => ["required", "email"],
        ];
    }
}
