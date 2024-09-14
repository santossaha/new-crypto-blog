<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventsResource;
use App\Models\EventsModel;
use Exception;
use Illuminate\Http\Request;

class EventsController extends Controller
{
	public function get_events()
	{
		try {

			$events = EventsModel::orderBy('id', 'desc')->get();
			$getEvents = EventsResource::collection($events);
			return response()->json(['status' => 'sucess', $getEvents]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
}
