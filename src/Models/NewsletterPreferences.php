<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Enums\AvailableNewsletter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property AvailableNewsletter $preference
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property-read NewsletterSubscriber $subscriber
 */
class NewsletterPreferences extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $fillable = [
        "preference",
    ];
    protected $casts = [
        "preference" => AvailableNewsletter::class,
    ];

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(NewsletterSubscriber::class);
    }
}
