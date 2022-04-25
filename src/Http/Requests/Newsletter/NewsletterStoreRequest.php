<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Newsletter;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => ["required", "string", "email", "max:255"],
        ];
    }
}
