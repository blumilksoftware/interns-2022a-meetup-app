<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Formats;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meetup extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "date",
        "place",
        "language",
    ];

    protected $casts = [
        "date:" . Formats::DATETIME,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function speakers(): HasMany
    {
        return $this->hasMany(Speaker::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
