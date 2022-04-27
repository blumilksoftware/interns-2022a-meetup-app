<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Models\Utils\Formats;
use Database\Factories\SpeakerFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $avatarPath
 * @property string|null $linkedinUrl
 * @property string|null $githubUrl
 * @property-read Collection<Meetup> $meetups
 */
class Speaker extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $primaryKey = "id";
    protected $fillable = [
        "name",
        "description",
        "avatar_path",
        "linkedin_url",
        "github_url",
    ];
    protected $attributes = [
        "avatar_path" => Constants::SPEAKER_DEFAULT_AVATAR_PATH,
    ];
    protected $casts = [
        "date:" . Formats::DATETIME,
    ];

    public function meetups(): BelongsToMany
    {
        return $this->belongsToMany(Meetup::class);
    }

    public function getAvatarPathAttribute(): string
    {
        return asset($this->attributes["avatar_path"]);
    }

    protected static function newFactory(): SpeakerFactory
    {
        return SpeakerFactory::new();
    }
}
