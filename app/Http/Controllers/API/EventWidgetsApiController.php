<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventWidgetsApiController extends ApiBaseController
{
    /**
     * Show the event widgets page
     *
     * @param Request $request
     * @param $event_id
     * @return mixed
     */
    public function showEventWidgets(Request $request, $event_id)
    {
        $event = Event::scope()->findOrFail($event_id);

        $data = [
            'event' => $event,
        ];


        return response()->json([
            'status'  => 'success',
            'data' => $data,
        ]);
    }
}
