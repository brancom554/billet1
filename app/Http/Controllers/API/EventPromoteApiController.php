<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventPromoteApiController extends ApiBaseController
{
    /**
     * @param $event_id
     * @return mixed
     */
    public function showPromote($event_id)
    {
        $data = [
            'event' => Event::scope()->find($event_id),
        ];

        return response()->json([
            'status'  => 'success',
            'data' => $data,
        ]);
    }
}
