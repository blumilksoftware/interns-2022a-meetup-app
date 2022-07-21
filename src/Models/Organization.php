<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Constants;
use Database\Factories\OrganizationFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Kyslik\ColumnSortable\Sortable;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $location
 * @property string $organizationType
 * @property Carbon $foundationDate
 * @property int $numberOfEmployees
 * @property string $logoPath
 * @property-read Collection<Meetup> $meetups
 * @property-read Collection<OrganizationProfile> $organizationProfiles
 */
class Organization extends Model
{
    use HasFactory;
    use Sortable;

    public $incrementing = true;
    protected $primaryKey = "id";
    protected $fillable = [
        "name",
        "description",
        "location",
        "organization_type",
        "foundation_date",
        "number_of_employees",
        "logo_path",
        "website_url",
    ];
    protected array $sortable = [
        "name",
        "location",
        "organization_type",
        "foundation_date",
        "number_of_employees",
    ];
    protected $attributes = [
        "logo_path" => Constants::ORGANIZATION_DEFAULT_LOGO_PATH,
    ];
    protected $casts = [
        "foundation_date" => "datetime",
    ];

    public function meetups(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }

    public function organizationProfiles(): HasMany
    {
        return $this->hasMany(OrganizationProfile::class);
    }

    public function getLogoPathAttribute(): string
    {
        return asset($this->attributes["logo_path"]);
    }

    protected static function newFactory(): OrganizationFactory
    {
        return OrganizationFactory::new();
    }
}
