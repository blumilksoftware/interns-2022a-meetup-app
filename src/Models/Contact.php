<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

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
