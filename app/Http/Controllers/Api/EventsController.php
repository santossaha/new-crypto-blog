<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventsResource;
use App\Models\EventsModel;
use Exception;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    //get all active Events
    public function get_events()
    {
        try {
            $events = EventsModel::where('status', 'Active')->select('id', 'title', 'slug', 'location', 'start_date', 'end_date')->orderBy('id', 'desc')->paginate(10);
            return response()->json(['status' => 'sucess', 'data' => $events]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

	public function search_events(Request $request)
	{
		try {
			$title = $request->get('title');
			$event_type = $request->get('event_type');
			$events = EventsModel::orderBy('id', 'desc')->where('title', 'LIKE', "%{$title}%")
    ->where('event_type', $event_type)->get();
			$getEvents = EventsResource::collection($events);
			return response()->json(['status' => 'sucess', $getEvents]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
}
