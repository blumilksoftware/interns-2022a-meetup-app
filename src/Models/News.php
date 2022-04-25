<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Formats;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Mews\Purifier\Casts\CleanHtml;

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
        "author",
        "slug",
        "title",
        "name",
        "content",
    ];
    protected $casts = [
        "content" => CleanHtml::class,
        "date:" . Formats::DATETIME,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
