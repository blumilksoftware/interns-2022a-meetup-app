<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $link
 * @property string $label
 * @property string $icon
 * @property-read int $organizationId
 * @property-read Organization $organization
 */
class OrganizationProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        "link",
        "label",
    ];

    public function getIconPath(): string
    {
        return strtolower(Constants::FA_BRANDS_PATH . $this->attributes["label"]);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
