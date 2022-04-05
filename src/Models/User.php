<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $emailVerifiedAt
 * @property string $password
 * @property string|null $rememberToken
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property-read Collection|array<Meetup> $meetups
 * @property-read int|null $meetupsCount
 * @property-read DatabaseNotificationCollection|array<DatabaseNotification> $notifications
 * @property-read int|null $notificationsCount
 * @property-read Collection|array<SocialAccount> $socialAccounts
 * @property-read int|null $socialAccountsCount
 * @property-read Collection|array<PersonalAccessToken> $tokens
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasApiTokens;
    use MustVerifyEmail;
    use Notifiable;

    protected $fillable = [
        "name",
        "email",
        "password",
    ];

    protected $hidden = [
        "password",
        "remember_token",
    ];

    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function meetups(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }

    public function socialAccounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }
}
