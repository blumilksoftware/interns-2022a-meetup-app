<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|email",
            "subject" => "required",
            "message" => "required",
        ];
    }
}
