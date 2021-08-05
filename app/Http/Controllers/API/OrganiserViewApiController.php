<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendize\Utils;
use App\Models\Organiser;
use Auth;

class OrganiserViewApiController extends ApiBaseController
{
    /**
     * Show the public organiser page
     *
     * @param $organiser_id
     * @param  string  $slug
     * @param  bool  $preview
     */
    public function showOrganiserHome(Request $request, $organiser_id, $slug = '', $preview = false)
    {
        /** @var Organiser $organiser */
        $organiser = Organiser::findOrFail($organiser_id);

        if (!$organiser->enable_organiser_page && !Utils::userOwns($organiser)) {
            abort(404);
        }

        /*
         * If we are previewing styles from the backend we set them here.
         */
        if ($request->get('preview_styles') && Auth::check()) {
            $query_string = rawurldecode($request->get('preview_styles'));
            parse_str($query_string, $preview_styles);

            $organiser->page_bg_color = $preview_styles['page_bg_color'];
            $organiser->page_header_bg_color = $preview_styles['page_header_bg_color'];
            $organiser->page_text_color = $preview_styles['page_text_color'];
        }

        $upcoming_events = $organiser->events()->where([
            ['end_date', '>=', now()],
            ['is_live', 1]
        ])->get();

        $past_events = $organiser->events()->where([
            ['end_date', '<', now()],
            ['is_live', 1]
        ])->limit(10)->get();

        $data = [
            'organiser'       => $organiser,
            'tickets'         => $organiser->events()->orderBy('created_at', 'desc')->get(),
            'is_embedded'     => 0,
            'upcoming_events' => $upcoming_events,
            'past_events'     => $past_events,
        ];

        return response()->json([
            'success'   =>  true,
            'data' => $data
        ], 200);

    }

    /**
     * Show the backend preview of the organiser page
     *
     * @param $event_id
     * @return mixed
     */
    public function showEventHomePreview($event_id)
    {
        return (new EventViewController)->showEventHome($event_id, true);
    }
}
