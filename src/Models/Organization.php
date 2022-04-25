<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Constants;
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
 * @property string $logoPath
 * @property-read Collection<Meetup> $meetups
 * @property-read Collection<OrganizationProfile> $organizationProfiles
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
        "logo_path",
        "website_url",
    ];
    protected $casts = [
        "foundation_date:" . Formats::DATETIME,
    ];

    public function getLogoPath(): string
    {
        return asset($this->attributes["logo_path"] ? "storage/" . $this->attributes["logo_path"] : Constants::ORGANIZATION_DEFAULT_LOGO_PATH);
    }

    public function meetups(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }

    public function organizationProfiles(): HasMany
    {
        return $this->hasMany(OrganizationProfile::class);
    }

    protected static function newFactory(): OrganizationFactory
    {
        return OrganizationFactory::new();
    }
}
