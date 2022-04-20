<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Formats;
use Database\Factories\SpeakerFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $avatarPath
 * @property string|null $linkedinUrl
 * @property string|null $githubUrl
 * @property-read Collection<Meetup> $meetup
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
    protected $casts = [
        "date:" . Formats::DATETIME,
    ];

    public function getAvatarPath(): string
    {
        return asset("storage/" . $this->attributes["avatar_path"]);
    }

    public function meetup(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }

    protected static function newFactory(): SpeakerFactory
    {
        return SpeakerFactory::new();
    }
}
