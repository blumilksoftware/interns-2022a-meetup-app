<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Database\Factories\UserFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $emailVerifiedAt
 * @property string $password
 * @property string|null $rememberToken
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 * @property boolean $hasTwoFaEnable
 * @property-read Collection<Meetup> $meetups
 * @property-read DatabaseNotificationCollection<DatabaseNotification> $notifications
 * @property-read Collection<SocialAccount> $socialAccounts
 * @property-read Collection<PersonalAccessToken> $tokens
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, MustVerifyEmailContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasApiTokens;
    use MustVerifyEmail;
    use Notifiable;
    use HasFactory;
    use HasRoles;
    use Sortable;

    public $incrementing = true;
    protected $primaryKey = "id";
    protected $fillable = [
        "name",
        "email",
        "password",
        "avatar_path",
        "has_two_fa_enable",
    ];
    protected array $sortable = [
        "id",
        "name",
        "email",
        "created_at",
        "updated_at",
    ];
    protected $hidden = [
        "password",
        "remember_token",
    ];
    protected $casts = [
        "email_verified_at" => "datetime",
        "birthday" => "date",
    ];
    protected $with = [
        "profile",
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function meetups(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }

    public function socialAccounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function getAvatarPathAttribute(): string
    {
        return asset($this->attributes["avatar_path"]);
    }

    public function code(): HasOne
    {
        return $this->hasOne(UserTwoFaCode::class);
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
