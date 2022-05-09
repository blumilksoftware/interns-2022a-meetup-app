<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "limit" => ["integer"],
        ];
    }
}
