<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required",
            "content" => "required",
        ];
    }
}
