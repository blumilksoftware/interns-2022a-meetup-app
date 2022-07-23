<?php

declare(strict_types=1);

namespace Blumilk\Meetup\Core\Exceptions;

use Exception;

class UserHasTwoFactorException extends Exception
{
    public function render($request)
    {
        return redirect()->route("twoFa.index");
    }
}
