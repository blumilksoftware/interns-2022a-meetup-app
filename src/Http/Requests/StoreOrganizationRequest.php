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
            "website_url" => "nullable|url",
            "facebook_url" => "nullable|url",
            "linkedin_url" => "nullable|url",
            "instagram_url" => "nullable|url",
            "youtube_url" => "nullable|url",
            "twitter_url" => "nullable|url",
            "github_url" => "nullable|url",
        ];
    }
}
