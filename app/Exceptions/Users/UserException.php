<?php

namespace App\Exceptions\Users;

use DomainException;

class UserException extends DomainException
{
    public static function UserAlreadyCreated(string $email) : self
    {
        return new self("This user ({$email}) has already been created!");
    }
}
