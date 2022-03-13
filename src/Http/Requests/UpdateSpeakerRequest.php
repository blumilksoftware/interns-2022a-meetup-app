<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpeakerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required",
            "description" => "nullable",
            "avatar" => "nullable",
            "linkedin_url" => "nullable",
            "github_url" => "nullable",
        ];
    }
}
