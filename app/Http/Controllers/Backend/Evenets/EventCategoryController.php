<?php

namespace App\Http\Controllers\Backend\Evenets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Str;
use Yajra\DataTables\Facades\DataTables;
use App\Models\BlogCategory;
class EventCategoryController extends Controller
{
  
    public function allBlogCat(){
        return view('Backend.events.Category.All');
    }
    public function addCat(){
        return  view('Backend.events.Category.Add');
    }
    public function saveCat(Request $request){
        $request->validate([
            'name' => 'bail|required|unique:blog_categories|max:255',
          
        ]);
        $save = new BlogCategory();
        $save->name = $request->get('name');
        $save->slug =  Str::slug($request->get('name'));
        $save->type = 'Event';
        $save->save();
        Session::flash('success', "Category has been create");
        return redirect()->back();
    }
    public function allCatDatabase(){
        $query = BlogCategory::select('id','name','type')->where('type','Event');
        return DataTables::eloquent($query)
            ->addColumn('action', function ($data) {
                $url_update = route('editEventsCat', ['id' => $data->id]);
                $url_delete = route('deleteEventsCat', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit Category" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Category Name: <span class=&#034;label label-primary&#034;>' . $data['name'] . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                return $edit;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    public function editCat($id=null){
        $records = BlogCategory::findOrFail($id);
        return view('Backend.events.Category.Edit',['records'=>$records]);
    }
    public function deleteCat($id=null){
        $remove = BlogCategory::findOrFail($id);
        $remove->delete();
        return redirect()->back();
    }
    public function updateCat(Request $request,$id=null){
        $update = BlogCategory::findOrFail($id);
        $update->name = $request->get('name');
        $update->slug =  Str::slug($request->get('name'));
        $update->type = 'Event';

        $update->save();
        Session::flash('success', "Category has been update");
        return redirect()->back();
    }
}
