<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AirDrops;
use Exception;
use Illuminate\Http\Request;

class AirDropsController extends Controller
{

public function get_airdrops(Request $request){

    try {
        $title = $request->get('name');
        $event_type = $request->get('airdrop_status');
        $events = AirDrops::orderBy('id', 'desc')->where('name', 'LIKE', "%{$title}%")
->where('airdrop_status', $event_type)->get();


      //  $getEvents = EventsResource::collection($events);

        return response()->json(['status' => 'sucess', $events]);
    } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

public function allArirDrops(Request $request){
    try {
        $query = AirDrops::query();
        if($request->has('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }
        if($request->has('airdrop_status')) {
            $query->where('airdrop_status', $request->airdrop_status);
        }

        if($request->has('airdrop_type')) {
            $query->where('airdrop_type', $request->airdrop_type);
        }

        $airdrop = $query->orderBy('id', 'DESC')->paginate(10);
        return response()->json(['status' => 'sucess', 'airdrop' => $airdrop]);
    } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

public function details_airdrops($name){
    try {

        $details =   AirDrops::where('name',$name)->first();
        return response()->json(['status' => 'sucess', $details]);
    } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }

}
}
