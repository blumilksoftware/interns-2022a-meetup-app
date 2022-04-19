<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Formats;
use Database\Factories\OrganizationFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $location
 * @property string $organizationType
 * @property string $foundationDate
 * @property string $numberOfEmployers
 * @property string $logo
 * @property string|null $websiteUrl
 * @property string|null $facebookUrl
 * @property string|null $linkedinUrl
 * @property string|null $instagramUrl
 * @property string|null $youtubeUrl
 * @property string|null $twitterUrl
 * @property string|null $githubUrl
 * @property-read Collection<Meetup> $meetups
 */
class Organization extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $primaryKey = "id";
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
        "foundation_date:" . Formats::DATETIME,
    ];

    public function getLogoPath(): string
    {
        return asset("storage/" . $this->attributes["logo"]);
    }

    public function meetups(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }

    protected static function newFactory(): OrganizationFactory
    {
        return OrganizationFactory::new();
    }
}
