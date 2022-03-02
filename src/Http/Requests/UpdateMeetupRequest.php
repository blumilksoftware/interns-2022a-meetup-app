<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeetupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => "required",
            "description" => "nullable",
            "date" => "required",
            "place" => "required",
            "language" => "required",
        ];
    }
}
