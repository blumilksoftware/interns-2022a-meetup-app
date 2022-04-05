<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Formats;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $avatarPath
 * @property string|null $linkedinUrl
 * @property string|null $githubUrl
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property-read Collection|array<Meetup> $meetup
 */
class Speaker extends Model
{
    use HasFactory;

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

    public function meetup(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }
}
