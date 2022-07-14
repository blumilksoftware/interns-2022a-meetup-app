<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class User2FaCode extends Model
{
    use HasFactory;

    public $incrementing = true;
    public $table = "user_2fa_codes";
    protected $primaryKey = "id";
    protected $fillable = [
        "user_id",
        "code",
    ];
}
