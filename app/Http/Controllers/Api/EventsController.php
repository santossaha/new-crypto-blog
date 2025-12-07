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
            $events = EventsModel::where('status', 'Active')->select('id', 'title', 'slug', 'location', 'from_date', 'to_date', 'start_date', 'end_date')->orderBy('id', 'desc')->paginate(10);
            // Format dates to DD-MM-YYYY
            $events->getCollection()->transform(function ($event) {
                if ($event->from_date) {
                    $event->from_date = date('d-m-Y', strtotime($event->from_date));
                } elseif ($event->start_date) {
                    $event->from_date = date('d-m-Y', strtotime($event->start_date));
                }
                if ($event->to_date) {
                    $event->to_date = date('d-m-Y', strtotime($event->to_date));
                } elseif ($event->end_date) {
                    $event->to_date = date('d-m-Y', strtotime($event->end_date));
                }
                // Keep backward compatibility
                if ($event->start_date) {
                    $event->start_date = date('d-m-Y', strtotime($event->start_date));
                }
                if ($event->end_date) {
                    $event->end_date = date('d-m-Y', strtotime($event->end_date));
                }
                return $event;
            });
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
