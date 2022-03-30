<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Formats;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "avatar_path",
        "linkedin_url",
        "github_url",
    ];

    protected $casts = [
        "date:" . Formats::DATETIME,
    ];

    public function meetup(): HasMany
    {
        return $this->hasMany(Meetup::class);
    }
}
