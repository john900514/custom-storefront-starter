<?php

namespace App\Projectors\Users;

use App\Models\User;
use App\StorableEvents\Users\UserCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class UserProjector extends Projector
{
    public function onUserCreated(UserCreated $event)
    {
        $user = User::create($event->detail);
        $user->update(['id' => $event->user_id]);
    }
}
