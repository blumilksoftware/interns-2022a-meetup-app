<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $email
 * @property string $status
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property-read Collection<NewsletterPreferences> $preferences
 * @property-read DatabaseNotificationCollection<DatabaseNotification> $notifications
 */
class NewsletterSubscriber extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        "email",
        "status",
    ];

    public function preferences(): HasMany
    {
        return $this->hasMany(NewsletterPreferences::class);
    }

    public function routeNotificationForMail(): array
    {
        return [
            config("mail.from.address") => config("mail.from.name"),
        ];
    }
}
