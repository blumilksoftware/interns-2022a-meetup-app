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
            env("MAIL_FROM_ADDRESS") => env("MAIL_FROM_NAME"),
        ];
    }
}
