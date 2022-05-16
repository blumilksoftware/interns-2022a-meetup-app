<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Constants;
use Blumilk\Meetup\Core\Models\Utils\Formats;
use Database\Factories\NewsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $userId
 * @property string $name
 * @property string|null $text
 * @property string $logoPath
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property-read User $user
 */
class News extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $primaryKey = "id";
    protected $fillable = [
        "slug",
        "title",
        "name",
        "text",
        "logo_path",
    ];
    protected $attributes = [
        "logo_path" => Constants::NEWS_DEFAULT_LOGO_PATH,
    ];
    protected $casts = [
        "date:" . Formats::DATETIME,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getLogoPathAttribute(): string
    {
        return asset($this->attributes["logo_path"]);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (self $news): void {
            $news->slug = Str::slug($news->title);
        });
    }

    protected static function newFactory(): NewsFactory
    {
        return NewsFactory::new();
    }
}
