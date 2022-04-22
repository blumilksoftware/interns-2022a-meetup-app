<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => ["required"],
            "description" => ["nullable"],
            "location" => ["required"],
            "organization_type" => ["required"],
            "foundation_date" => ["required"],
            "number_of_employees" => ["required"],
            "logo_path" => ["required", "image", "max:2048"],
            "website_url" => ["nullable", "url"],
        ];
    }
}
