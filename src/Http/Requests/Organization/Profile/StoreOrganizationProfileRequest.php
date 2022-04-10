<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Organization\Profile;

use Blumilk\Meetup\Core\Enums\AvailableProfiles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreOrganizationProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "link" => ["required", "url"],
            "label" => ["required", new Enum(AvailableProfiles::class)],
        ];
    }
}
