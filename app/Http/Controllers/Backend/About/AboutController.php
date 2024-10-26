<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;

use App\Models\About;
use Illuminate\Http\Request;
use Session;
use Yajra\DataTables\Facades\DataTables;

class AboutController extends Controller
{
    public function allAbout(){



        
     
        return view('Backend.About.All');
    }
    public function addAbout(){
        return  view('Backend.About.Add');
    }
    public function saveAbout(Request $request){
        $save = new About();
        $save->title = $request->get('title');
        $save->description = $request->get('content');
        if ($request->hasFile('image')) {
            $file            = $request->file('image');
            $Imagename  = time().'aboutus'.'.'. $file->getClientOriginalExtension();
            $file->storeAs('aboutus', $Imagename, 'public');
            $save->image= $Imagename;
        }
        $save->save();
        \Session::flash('success', "About us content has been create");
        return redirect()->back();
    }
    public function allAboutDatabase(){
        $query = About::select('id','image','title');
        return DataTables::eloquent($query)
            ->addColumn('image', function ($data) {
                if($data->image!=''){
                    return '<img src="'.$data->image.'" width="80px" />';
                }else{
                    return 'N/A';
                }
            })
            ->addColumn('action', function ($data) {
                $url_update = route('editAbout', ['id' => $data->id]);
                $url_delete = route('deleteAbout', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit About us Content" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete About us Content: <span class=&#034;label label-primary&#034;>' . $data->title . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                return $edit;
            })
            ->rawColumns(['id','action','image'])
            ->toJson();
    }
    public function editAbout($id=null){
        $records = About::findOrFail($id);
        return view('Backend.About.Edit',[
            'records'=>$records,
        ]);
    }
    public function updateAbout(Request $request,$id=null){
        $update = About::findOrFail($id);
        $update->title = $request->get('title');
        $update->description = $request->get('content');
        if(!empty($request->file('image'))){


            $file  = $request->file('image');
           
            $Imagename  = time().'aboutus'.'.'. $file->getClientOriginalExtension();
            $file->storeAs('aboutus', $Imagename, 'public');

            if(file_exists($update->image)){
                unlink($update->image);
            }
            $pro_photo  = $Imagename;
        }else{

            $end = explode('/',$update->image);
            
            $pro_photo= end($end);
        }
        $update->image = $pro_photo;
        $update->save();
        Session::flash('success', "About us content has been update");
        return redirect()->back();
    }
    public function deleteAbout($id=null){
        $remove = About::findOrFail($id);
        $remove->delete();
        return redirect()->back();
    }
}
