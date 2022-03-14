<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        "date" => "datetime:Y-m-d h:i:s",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
