<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Exceptions;

use Exception;

class PasswordDoesMatchException extends Exception
{
    protected $message = "Password cannot be the same as old password";
}
