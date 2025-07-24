<?php

namespace App\Http\Controllers\Backend\Evenets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EventsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\uploadImage;

class EventController extends Controller
{
    public function allEvents(){
        return view('Backend.events.All');
    }
    public function addEvents(){
        return  view('Backend.events.Add');
    }
    public function saveEvents(Request $request){
        $this->validate($request,[
            'title' => 'required|unique:blog_details,title,NULL,id,deleted_at,NULL',
            'meta_title'=>'required',
            'meta_description'=> 'required',
            'meta_keyword'=>'required',
            'image'=> 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'canonical'=> 'required',
            'start_date'=>'required|date',
            'end_date'=> 'required|date',
            'location'=>'required',
            'description'=>'required'
        ]);
        $user_id = Auth::User()->id;
        $save = new EventsModel();
        $save->user_id = $user_id;
        $save->title = $request->get('title');
        $save->slug = Str::slug($request->get('title'));
        $save->meta_title = $request->get('meta_title');
        $save->meta_description = $request->get('meta_description');
        $save->description = $request->get('description');
        $save->author = $user_id;
        $save->canonical = $request->get('canonical');
        $save->meta_keyword = $request->get('meta_keyword');
        $save->location = $request->get('location');
        $save->approve_status= 'Aprroved';
        $save->start_date =  date('Y-m-d', strtotime($request->get('start_date')));
        $save->end_date =  date('Y-m-d', strtotime($request->get('end_date')));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $save->image = uploadImage($file, 'event');
        }
        $save->save();

        Session::flash('success', "Event has been create");
        return redirect()->back();
    }
    public function allEventsDatabase(){
        $query = EventsModel::select('id','image','title');
        return DataTables::eloquent($query)
        ->addColumn('image', function ($data) {
            if($data->image!=''){
                return '<img src="'.$data->image.'" width="100px" />';
            }else{
                return 'N/A';
            }
        })

            ->addColumn('action', function ($data) {
                $url_update = route('editEvent', ['id' => $data->id]);
                $url_delete = route('deleteEvent', ['id' => $data->id]);
                $edit = '<a class="label label-primary"   href="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Blog Name: <span class=&#034;label label-primary&#034;>' . $data->title . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                return $edit;
            })
            ->rawColumns(['id','action','image'])
            ->toJson();
    }
    public function editEvents($id=null){
        $records = EventsModel::findOrFail($id);
        return view('Backend.events.Edit',[
            'records'=>$records,
        ]);
    }
    public function updateEvents(Request $request,$id=null){
        $this->validate($request,[
            'title' => 'required|unique:blog_details,title,'.$id.',id,deleted_at,NULL',
            'description'=>'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        $user_id = Auth::User()->id;
        $update = EventsModel::findOrFail($id);
        $update->user_id = $user_id;
        $update->title = $request->get('title');
        $update->slug = Str::slug($request->get('title'));
        $update->meta_title = $request->get('meta_title');
        $update->meta_description = $request->get('meta_description');
        $update->author = $request->get('author');
        $update->description = $request->get('description');
        //$update->short_description = $request->get('short_description');
        $update->canonical = $request->get('canonical');
        $update->meta_keyword = $request->get('meta_keyword');
        $update->location = $request->get('location');
        $update->start_date =  date('Y-m-d', strtotime($request->get('start_date')));
        $update->end_date =  date('Y-m-d', strtotime($request->get('end_date')));

        if(!empty($request->file('image'))){
            $file = $request->file('image');
            $update->image = uploadImage($file, 'event', $update->image);
        }

        $update->save();
        Session::flash('success', "Events has been update");
        return redirect()->back();
    }
    public function deleteEvents($id=null){
        $remove = EventsModel::findOrFail($id);
        $remove->delete();
        return redirect()->back();
    }
}
