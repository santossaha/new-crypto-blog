<?php

namespace App\Http\Controllers\Backend\Blog\AllBlog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function allBlog(){
        $query = BlogDetail::select('id','image','title','category_id')->where('type','Blog')->first();
        //dd($query->image);
        return view('Backend.Blog.AllBlog.All');
    }
    public function addBlog(){
        $getBlogCats = BlogCategory::where('type','blog')->get();
        return  view('Backend.Blog.AllBlog.Add',['getBlogCats'=>$getBlogCats]);
    }
    public function saveBlog(Request $request){
        $this->validate($request,[
            'title' => 'required|unique:blog_details,title,NULL,id,deleted_at,NULL',
            'meta_title'=>'required',
            'meta_description'=> 'required',
            'meta_keyword'=>'required',
            'image'=> 'required',
            'cat_name'=> 'required',
            //'description'=> 'required',
            //'short_description'=> 'required',
            'canonical'=> 'required',
        ]);
        $user_id = Auth::User()->id;
        $save = new BlogDetail();
        $save->category_id = $request->get('cat_name');
        $save->user_id = $user_id;
        $save->title = $request->get('title');
        $save->slug = Str::slug($request->get('title'));
        $save->content = $request->get('description') ?? '';
        $save->meta_title = $request->get('meta_title');
        $save->meta_description = $request->get('meta_description') ?? '';
        $save->author = Auth::User()->id;
        $save->short_description = $request->get('short_description') ?? '';
        $save->canonical = $request->get('canonical');
        $save->meta_keyword = $request->get('meta_keyword');
        if ($request->hasFile('image')) {
            $save->image = uploadImage($request->file('image'), 'blog_images', null, 'blog_images');
        }
        $save->save();
        Session::flash('success', "blog has been create");
        return redirect()->back();
    }
    public function allBlogDatabase(){
        $query = BlogDetail::select('id','image','title','category_id')->where('type','Blog');
        return DataTables::eloquent($query)
            ->addColumn('image', function ($data) {
                if($data->image!=''){
                    return '<img src="'.getFullPath('blog_images',$data->image).'" width="100px" />';
                }else{
                    return 'N/A';
                }
            })
            ->addColumn('category', function($data) {
                return  $data->BlogCategory['name'];
            })
            ->addColumn('action', function ($data) {
                $url_update = route('editBlog', ['id' => $data->id]);
                $url_delete = route('deleteBlog', ['id' => $data->id]);
                // $url_comment = route('allComment', ['id' => $data->id]);
                $edit = '<a class="label label-primary"  href="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Blog Name: <span class=&#034;label label-primary&#034;>' . $data->title . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                // $edit .= '&nbsp<a href="' . $url_comment . '" class="label label-success"</span><i class="fa fa-envelope-o"></i> Comments </a>';
                return $edit;
            })
            ->rawColumns(['id','action','image'])
            ->toJson();
    }
    public function editBlog($id=null){
        $getBlogCats = BlogCategory::where('type','blog')->get();
        $records = BlogDetail::findOrFail($id);
        return view('Backend.Blog.AllBlog.Edit',[
            'records'=>$records,
            'getBlogCats'=>$getBlogCats,
        ]);
    }
    public function updateBlog(Request $request,$id=null){
        //dd($request->file('image'));
        $this->validate($request,[
            'title' => 'required|unique:blog_details,title,'.$id.',id,deleted_at,NULL',
        ]);

        $user_id = Auth::User()->id;
        $update = BlogDetail::findOrFail($id);
        $update->category_id = $request->get('cat_name');
        $update->user_id = $user_id;
        $update->title = $request->get('title');
        $update->slug = Str::slug($request->get('title'));
        $update->content = $request->get('content');

        $update->meta_title = $request->get('meta_title');
        $update->meta_description = $request->get('meta_description');
        $update->author = $request->get('author');
        $update->short_description = $request->get('short_description');
        $update->canonical = $request->get('canonical');
        $update->meta_keyword = $request->get('meta_keyword');


        if(!empty($request->file('image'))){

            $update->image = uploadImage($request->file('image'), 'blog_images', $update->image, 'blog_images');
        }

        $update->save();
        Session::flash('success', "Blog has been update");
        return redirect()->back();
    }
    public function deleteBlog($id=null){
        $remove = BlogDetail::findOrFail($id);

        // Delete the image if it exists
        if ($remove->image) {
            deleteImage(getImageUrl('blog', $remove->image));
        }

        $remove->delete();
        return redirect()->back();
    }

}
