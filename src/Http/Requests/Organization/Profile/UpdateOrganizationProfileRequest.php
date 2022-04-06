<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Organization\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "link" => ["required", "url"],
            "label" => ["required", "in:Website,Facebook,Linkedin,Instagram,YouTube,Twitter,GitHub"],
        ];
    }
}
