<?php

namespace App\Aggregates\Users;

use App\Exceptions\Users\UserException;
use App\StorableEvents\Users\UserCreated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class UserAggregate extends AggregateRoot
{
    protected string|null $email = null;

    public function applyUserCreated(UserCreated $event)
    {
        $this->email = $event->email;
    }

    public function createNewUser($email, $details) : self
    {

        if(!is_null($this->email))
        {
            throw UserException::UserAlreadyCreated($email);
        }

        $this->recordThat(new UserCreated($this->uuid(), $details, $email));
        return $this;
    }
}
