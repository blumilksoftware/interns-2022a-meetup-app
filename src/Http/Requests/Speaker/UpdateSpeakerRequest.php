<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests\Speaker;

use Blumilk\Meetup\Core\Http\Requests\Speaker\Rules\AvatarFileRules;
use Blumilk\Meetup\Core\Http\Requests\Speaker\Rules\GithubLinkRules;
use Blumilk\Meetup\Core\Http\Requests\Speaker\Rules\LinkedinLinkRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSpeakerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required",
            "description" => "nullable",
            "avatar" => AvatarFileRules::rules(),
            "linkedin_url" => LinkedinLinkRules::rules(),
            "github_url" => GithubLinkRules::rules(),
        ];
    }
}
