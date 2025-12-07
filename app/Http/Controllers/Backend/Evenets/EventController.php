<?php

namespace App\Http\Controllers\Backend\Evenets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EventsModel;
use App\Models\EventGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\uploadImage;

class EventController extends Controller
{
    const IMAGE_DIRECTORY_EVENT = 'event';
    const IMAGE_DIRECTORY_GALLERY = 'event/gallery';
    const IMAGE_PREFIX = 'event';
    public function allEvents(){
        return view('Backend.events.All');
    }
    public function addEvents(){
        return  view('Backend.events.Add');
    }
    public function saveEvents(Request $request){

        $this->validate($request,[
            'title' => 'required|unique:events,title',
            'content' => 'required',
            'from_date'=>'required|date_format:d-m-Y',
            'to_date'=> 'required|date_format:d-m-Y|after_or_equal:from_date',
            'start_time' => 'nullable',
            'to_time' => 'nullable',
            'location'=>'required',
            'contact_detail' => 'nullable',
            'email' => 'nullable|email',
            //'website_url' => 'nullable|url',
            //'facebook' => 'nullable|url',
            //'instagram' => 'nullable|url',
            //'linkedin' => 'nullable|url',
            'image'=> 'required|image|mimes:jpeg,jpg,png,gif,svg|max:4096',
            //'description'=>'required',
            //'meta_title'=>'required',
            //'meta_description'=> 'required',
            //'meta_keyword'=>'required',
            //'canonical'=> 'required',
            //'gallery_images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:4096'
        ]);

        $user_id = Auth::User()->id;
        $save = new EventsModel();
        $save->user_id = $user_id;
        $save->title = $request->get('title');
        $save->slug = Str::slug($request->get('title'));
        $save->content = $request->get('content');
        // Convert DD-MM-YYYY to YYYY-MM-DD for database
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');
        $save->from_date = $this->convertDateFormat($fromDate);
        $save->to_date = $this->convertDateFormat($toDate);
        $save->start_time = $request->get('start_time') ? date('H:i:s', strtotime($request->get('start_time'))) : null;
        $save->to_time = $request->get('to_time') ? date('H:i:s', strtotime($request->get('to_time'))) : null;
        $save->location = $request->get('location');
        $save->contact_detail = $request->get('contact_detail');
        $save->email = $request->get('email');
        $save->website_url = $request->get('website_url');
        $save->facebook = $request->get('facebook');
        $save->instagram = $request->get('instagram');
        $save->linkedin = $request->get('linkedin');
        $save->meta_title = $request->get('meta_title');
        $save->meta_description = $request->get('meta_description');
        $save->description = $request->get('description');
        $save->author = $user_id;
        $save->canonical = $request->get('canonical');
        $save->meta_keyword = $request->get('meta_keyword');
        $save->status = 'Active';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $save->image = uploadImage($file, self::IMAGE_DIRECTORY_EVENT, self::IMAGE_PREFIX);
        }
        $save->save();

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $sortOrder = 0;
            foreach ($request->file('gallery_images') as $galleryImage) {
                $gallery = new EventGallery();
                $gallery->event_id = $save->id;
                $gallery->image = uploadImage($galleryImage, self::IMAGE_DIRECTORY_GALLERY, self::IMAGE_PREFIX);
                $gallery->sort_order = $sortOrder++;
                $gallery->save();
            }
        }

        Session::flash('success', "Event has been created");
        return redirect()->back();
    }
    public function allEventsDatabase(){
        $query = EventsModel::select('id','image','title','from_date','to_date','status');
        return DataTables::eloquent($query)
        ->addColumn('image', function ($data) {
            if($data->image!=''){
                return '<img src="'.getFullPath(self::IMAGE_DIRECTORY_EVENT, $data->image).'" width="100px" />';
            }else{
                return 'N/A';
            }
        })
        ->addColumn('from_date', function ($data) {
            if($data->from_date){
                return date('d-m-Y', strtotime($data->from_date));
            }else{
                return 'N/A';
            }
        })
        ->addColumn('to_date', function ($data) {
            if($data->to_date){
                return date('d-m-Y', strtotime($data->to_date));
            }else{
                return 'N/A';
            }
        })
        ->addColumn('status', function ($data) {
            $status = $data->status ?? 'Active';
            if($status == 'Active' || $status == 'Inactive'){
                $checked = ($status == 'Active') ? 'checked' : '';
                return '<div style="display: block">
                    <label class="switch">
                        <input onchange="change_status_action('.$data->id.')" id="checkbox_'.$data->id.'" data-id="'.$data->id.'" type="checkbox" '.$checked.' />
                        <div class="slider round"></div>
                    </label>
                </div>';
            } else {
                return '<div style="display: block"><span>'.$status.'</span></div>';
            }
        })

            ->addColumn('action', function ($data) {
                $url_update = route('editEvent', ['id' => $data->id]);
                $url_delete = route('deleteEvent', ['id' => $data->id]);
                $edit = '<a class="label label-primary"   href="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Event Name: <span class=&#034;label label-primary&#034;>' . $data->title . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                return $edit;
            })
            ->rawColumns(['id','action','image','status'])
            ->toJson();
    }
    public function editEvents($id=null){
        $records = EventsModel::with('galleries')->findOrFail($id);
        return view('Backend.events.Edit',[
            'records'=>$records,
        ]);
    }
    public function updateEvents(Request $request,$id=null){
        $this->validate($request,[
            'title' => 'required|unique:events,title,'.$id,
            'content' => 'required',
            'from_date'=>'required|date_format:d-m-Y',
            'to_date'=> 'required|date_format:d-m-Y|after_or_equal:from_date',
            'start_time' => 'nullable',
            'to_time' => 'nullable',
            'location'=>'required',
            'contact_detail' => 'nullable',
            'email' => 'nullable|email',
            //'website_url' => 'nullable|url',
            //'facebook' => 'nullable|url',
            //'instagram' => 'nullable|url',
            //'linkedin' => 'nullable|url',
            //'description'=>'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:4096',
            //'gallery_images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ]);

        $user_id = Auth::User()->id;
        $update = EventsModel::findOrFail($id);
        $update->user_id = $user_id;
        $update->title = $request->get('title');
        $update->slug = Str::slug($request->get('title'));
        $update->content = $request->get('content');
        // Convert DD-MM-YYYY to YYYY-MM-DD for database
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');
        $update->from_date = $this->convertDateFormat($fromDate);
        $update->to_date = $this->convertDateFormat($toDate);
        $update->start_time = $request->get('start_time') ? date('H:i:s', strtotime($request->get('start_time'))) : null;
        $update->to_time = $request->get('to_time') ? date('H:i:s', strtotime($request->get('to_time'))) : null;
        $update->location = $request->get('location');
        $update->contact_detail = $request->get('contact_detail');
        $update->email = $request->get('email');
        $update->website_url = $request->get('website_url');
        $update->facebook = $request->get('facebook');
        $update->instagram = $request->get('instagram');
        $update->linkedin = $request->get('linkedin');
        $update->meta_title = $request->get('meta_title');
        $update->meta_description = $request->get('meta_description');
        $update->author = $request->get('author') ?? $user_id;
        $update->description = $request->get('description');
        $update->canonical = $request->get('canonical');
        $update->meta_keyword = $request->get('meta_keyword');

        if(!empty($request->file('image'))){
            $file = $request->file('image');
            $update->image = uploadImage($file, self::IMAGE_DIRECTORY_EVENT, $update->image, self::IMAGE_PREFIX);
        }

        $update->save();

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $existingGalleries = EventGallery::where('event_id', $id)->count();
            $sortOrder = $existingGalleries;
            foreach ($request->file('gallery_images') as $galleryImage) {
                $gallery = new EventGallery();
                $gallery->event_id = $id;
                $gallery->image = uploadImage($galleryImage, self::IMAGE_DIRECTORY_GALLERY, self::IMAGE_PREFIX);
                $gallery->sort_order = $sortOrder++;
                $gallery->save();
            }
        }

        Session::flash('success', "Event has been updated");
        return redirect()->back();
    }
    public function deleteEvents($id=null){
        $remove = EventsModel::findOrFail($id);
        // Delete gallery images
        $galleries = EventGallery::where('event_id', $id)->get();
        foreach ($galleries as $gallery) {
            if ($gallery->image) {
                deleteImage(getImageUrl(self::IMAGE_DIRECTORY_EVENT, $gallery->image));

            }
            $gallery->delete();
        }
        // Delete main image
        if ($remove->image) {
            deleteImage(getImageUrl(self::IMAGE_DIRECTORY_GALLERY, $remove->image));
        }
        $remove->delete();
        Session::flash('success', "Event has been deleted");
        return redirect()->back();
    }

    public function deleteGalleryImage($id=null){
        $gallery = EventGallery::findOrFail($id);
        if ($gallery->image) {
            deleteImage(getImageUrl(self::IMAGE_DIRECTORY_GALLERY, $gallery->image));
        }
        $gallery->delete();
        return response()->json(['success' => true, 'message' => 'Gallery image deleted successfully']);
    }

    public function statusEvent($id)
    {
        $item = EventsModel::find($id);

        if(empty($item)) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found!',
            ]);
        } else {
            if($item->status == 'Active' || $item->status == 'Inactive'){
                $item->status = ($item->status == 'Active' ? 'Inactive' : 'Active');
                $item->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Event status successfully changed.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status!',
                ]);
            }
        }
    }

    /**
     * Convert date from DD-MM-YYYY format to YYYY-MM-DD format
     *
     * @param string $date
     * @return string
     */
    private function convertDateFormat($date)
    {
        if (empty($date)) {
            return null;
        }

        // Check if date is in DD-MM-YYYY format
        if (preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $date, $matches)) {
            // Convert DD-MM-YYYY to YYYY-MM-DD
            return $matches[3] . '-' . $matches[2] . '-' . $matches[1];
        }

        // Try to parse with Carbon (handles various formats)
        try {
            return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Fallback to strtotime if Carbon fails
            return date('Y-m-d', strtotime($date));
        }
    }
}
