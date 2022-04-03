<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Newsletter;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => ["required"],
            "type" => ["required"],
        ];
    }
}
