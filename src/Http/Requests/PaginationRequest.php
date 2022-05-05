<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaginationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "limit" => ["integer", Rule::in([10, 30, 50, 100])],
        ];
    }
}
