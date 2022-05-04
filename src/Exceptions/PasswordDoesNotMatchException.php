<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Exceptions;

use Exception;

class PasswordDoesNotMatchException extends Exception
{
    protected $message = "The old password is invalid";
}
