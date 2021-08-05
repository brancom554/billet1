<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;


class EventViewEmbeddedApiController extends ApiBaseController
{
    /**
     * Show an embedded version of the event page
     *
     * @param $event_id
     * @return mixed
     */
    public function showEmbeddedEvent($event_id)
    {
        $event = Event::findOrFail($event_id);

        $data = [
            'event'       => $event,
            'tickets'     => $event->tickets()->where('is_hidden', 0)->orderBy('sort_order', 'asc')->get(),
            'is_embedded' => '1',
        ];

        return response()->json([
            'status'  => 'success',
            'message' => $data,
        ]);
    }
}
