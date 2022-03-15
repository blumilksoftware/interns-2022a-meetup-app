<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required",
            "description" => "nullable",
            "location" => "required",
            "organization_type" => "required",
            "foundation_date" => "required",
            "number_of_employers" => "required",
            "logo" => "required|image|max:2048",
            "*_url" => "nullable|url",
        ];
    }
}
