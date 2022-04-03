<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsletterSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        "email",
        "status",
    ];

    public function preferences(): HasMany
    {
        return $this->hasMany(NewsletterPreferences::class);
    }
}
