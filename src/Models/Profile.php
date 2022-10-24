<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $avatarPath
 * @property string|null $location
 * @property Carbon|null $birthday
 * @property string|null $gender
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 */
class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = "user_id";
    protected $fillable = [
        "avatar_path",
        "location",
        "birthday",
        "gender",
    ];
    protected array $sortable = [
        "location",
        "birthday",
        "gender",
    ];
    protected $attributes = [
        "avatar_path" => Constants::USER_DEFAULT_AVATAR_PATH,
    ];
    protected $casts = [
        "birthday" => "date",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAvatarPathAttribute(): string
    {
        return asset($this->attributes["avatar_path"]);
    }
}
