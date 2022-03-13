<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "avatar",
        "linkedin_url",
        "github_url",
    ];

    protected $casts = [
        "date" => "datetime:Y-m-d h:i:s",
    ];
}
