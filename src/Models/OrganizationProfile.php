<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganizationProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        "link",
        "label",
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
