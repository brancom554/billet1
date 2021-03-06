<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\EventAccessCodes;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class EventAccessCodesApiController extends ApiBaseController
{
    /**
     * @param $event_id
     * @return mixed
     */
    public function show($event_id)
    {
        $event = Event::scope()->findOrFail($event_id);

        return response()->json([
            'status'  => 'success',
            'event' => $event,
        ]);
    }

    /**
     * @param $event_id
     * @return Factory|View
     */
    public function showCreate($event_id)
    {
        return response()->json([
            'status'  => 'success',
            'event' => Event::scope()->find($event_id),
        ]);
    }

    /**
     * Creates a ticket
     *
     * @param Request $request
     * @param $event_id
     * @return JsonResponse
     */
    public function postCreate(Request $request, $event_id)
    {
        $eventAccessCode = new EventAccessCodes();

        if (!$eventAccessCode->validate($request->all())) {
            return response()->json([
                'status' => 'error',
                'messages' => $eventAccessCode->errors(),
            ]);
        }

        // Checks for no duplicates
        $newAccessCode = strtoupper($request->get('code'));
        if (EventAccessCodes::findFromCode($newAccessCode, $event_id)->count() > 0) {
            return response()->json([
                'status' => 'error',
                'messages' => [
                    'code' => [ trans('AccessCodes.unique_error') ],
                ],
            ]);
        }

        // Saves the new access code if validation and dupe check passed
        $eventAccessCode->event_id = $event_id;
        $eventAccessCode->code = $newAccessCode;
        $eventAccessCode->save();

        return response()->json([
            'status' => 'success',
            'id' => $eventAccessCode->id,
            'message' => trans('AccessCodes.success_message'),
            'event_id' => $event_id 
        ]);
    }

    /**
     * @param integer $event_id
     * @param integer $access_code_id
     * @return JsonResponse
     * @throws \Exception
     */
    public function postDelete($event_id, $access_code_id)
    {
        /** @var Event $event */
        $event = Event::scope()->findOrFail($event_id);

        if ($event->hasAccessCode($access_code_id)) {
            /** @var EventAccessCodes $accessCode */
            $accessCode = EventAccessCodes::find($access_code_id);
            if ($accessCode->usage_count > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => trans('AccessCodes.cannot_delete_used_code'),
                ]);
            }
            $accessCode->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => trans('AccessCodes.delete_message'),
            'event_id' => $event_id
        ]);
    }
}
