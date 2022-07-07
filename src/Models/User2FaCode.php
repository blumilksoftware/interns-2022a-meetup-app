<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Utils\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
