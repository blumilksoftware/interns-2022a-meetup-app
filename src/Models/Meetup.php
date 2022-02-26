<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        "date" => "datetime",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
