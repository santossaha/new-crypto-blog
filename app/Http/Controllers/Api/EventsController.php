<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventsResource;
use App\Models\EventsModel;
use Exception;
use Illuminate\Http\Request;

class EventsController extends Controller
{
	public function get_events(Request $request)
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
