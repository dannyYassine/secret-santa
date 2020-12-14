<?php

namespace App\Module\Exceptions;

class MinimumRequiredFriendsException extends \Error
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        if (empty($message)) {
            $message = 'Need at least two friends to send invites';
        }

        parent::__construct($message, $code, $previous);
    }
}
