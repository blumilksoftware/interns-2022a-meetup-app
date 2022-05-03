<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Blumilk\Meetup\Core\Http\Requests\Speaker\Rules\AvatarFileRules;
use Blumilk\Meetup\Core\Http\Requests\Speaker\Rules\GithubLinkRules;
use Blumilk\Meetup\Core\Http\Requests\Speaker\Rules\LinkedinLinkRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaginationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => ['required', 'integer', Rule::in([10, 30, 50, 100])]
        ];
    }
}
