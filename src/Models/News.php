<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Formats;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string|null $content
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property-read User $user
 */
class News extends Model
{
    use HasFactory;

    protected $fillable = [
        "author_id",
        "slug",
        "title",
        "name",
        "text",
    ];
    protected $casts = [
        "date:" . Formats::DATETIME,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($news): void {
            $news->slug = Str::slug($news->title);
        });
    }
}
