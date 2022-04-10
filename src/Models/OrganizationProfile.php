<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $link
 * @property string $label
 * @property string $icon
 * @property-read Organization $organization
 */
class OrganizationProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        "link",
        "label",
        "icon",
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
