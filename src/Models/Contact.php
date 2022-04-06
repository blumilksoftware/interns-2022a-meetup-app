<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property-read DatabaseNotificationCollection<DatabaseNotification> $notifications
 */
class Contact extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        "name",
        "email",
        "subject",
        "message",
    ];

    public function routeNotificationForMail(): array
    {
        return [
            config("mail.from.address") => config("mail.from.name"),
        ];
    }
}
