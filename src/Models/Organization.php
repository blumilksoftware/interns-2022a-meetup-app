<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "location",
        "organization_type",
        "foundation_date",
        "number_of_employers",
        "logo",
        "website_url",
        "facebook_url",
        "linkedin_url",
        "instagram_url",
        "youtube_url",
        "twitter_url",
        "github_url",
    ];

    protected $casts = [
        "foundation_date" => "datetime:Y-m-d h:i:s",
    ];

    public function meetups(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }
}
