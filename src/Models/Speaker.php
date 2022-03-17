<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
