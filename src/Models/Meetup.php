<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Models\Utils\Formats;
use Database\Factories\MeetupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $userId
 * @property int|null $organizationId
 * @property int|null $speakerId
 * @property string $title
 * @property string|null $description
 * @property string $date
 * @property string $place
 * @property string $language
 * @property string $logoPath
 * @property-read Organization|null $organization
 * @property-read Speaker|null $speakers
 * @property-read User $user
 */
class Meetup extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $primaryKey = "id";
    protected $fillable = [
        "title",
        "description",
        "date",
        "place",
        "language",
        "logo_path",
        "organization_id",
    ];
    protected $attributes = [
        "logo_path" => Constants::MEETUP_DEFAULT_LOGO_PATH,
    ];
    protected $casts = [
        "date:" . Formats::DATETIME,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function speakers(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function getLogoPathAttribute(): string
    {
        return asset($this->attributes["logo_path"]);
    }

    protected static function newFactory(): MeetupFactory
    {
        return MeetupFactory::new();
    }
}
