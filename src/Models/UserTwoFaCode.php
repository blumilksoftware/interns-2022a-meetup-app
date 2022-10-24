<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTwoFaCode extends Model
{
    use HasFactory;

    public $incrementing = true;
    public $table = "user_two_fa_codes";
    protected $primaryKey = "id";
    protected $fillable = [
        "user_id",
        "code",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
