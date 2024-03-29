<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Models;

use Blumilk\Meetup\Core\Models\Traits\CamelCaseAttributes;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Carbon;

/**
 * @property Carbon|null $createdAt
 * @property Carbon|null $updatedAt
 */
abstract class Model extends EloquentModel
{
    use CamelCaseAttributes;

    public $incrementing = false;
    protected $keyType = "string";
}
