<?php

namespace App\Actions\SegmentAPI\Calls;

use Segment\Segment;
use Lorisleiva\Actions\Concerns\AsAction;

class SegmentTrack
{
    use AsAction;

    public function handle(string $user_id, string $event, array $props)
    {
        Segment::init(env('SEGMENT'));
        Segment::track([
            "userId" => $user_id,
            "event" => $event,
            "properties" => $props
            ]
        );
    }
}
