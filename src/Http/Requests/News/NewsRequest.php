<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Mews\Purifier\Facades\Purifier;

class NewsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "title" => "required|string",
            "text" => "required|string",
        ];
    }

    protected function prepareForValidation(): void
    {
        $cleanText = Purifier::clean($this->text);
        $this->merge([
            "text" => strip_tags($cleanText),
        ]);
    }
}
