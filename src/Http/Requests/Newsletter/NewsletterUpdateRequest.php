<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Newsletter;

use Blumilk\Meetup\Core\Enums\AvailableNewsletter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsletterUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => ["required"],
            "type" => ["required", "array", Rule::in([AvailableNewsletter::MEETUPS->value, AvailableNewsletter::NEWS->value])],
        ];
    }
}
