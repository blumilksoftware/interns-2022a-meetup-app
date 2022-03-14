<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        "date" => "datetime:Y-m-d h:i:s",
    ];

    public function meetup(): BelongsTo
    {
        return $this->belongsTo(Meetup::class);
    }
}
