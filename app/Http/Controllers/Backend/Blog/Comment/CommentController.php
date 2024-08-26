<?php

namespace App\Http\Controllers\Backend\Blog\Comment;

use App\Http\Controllers\Controller;
use App\Model\Comment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{
    public function allComment($id){
        return view('Backend.Blog.Comment.All',['id' => $id]);

    }
    public function allCommentDatabase ($id){
        $query = Comment::select('id','name','email','number')->where('blog_details_id',$id);
        return DataTables::eloquent($query)
            ->addColumn('action', function ($data) {
                $url_update = route('viewComment', ['id' => $data->id]);
                $url_delete = route('deleteComment', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit Category" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Category Name: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                return $edit;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    public function viewComment($id=null){
        $records = Comment::findOrFail($id);
        return view('Backend.Blog.Comment.Edit',['records'=>$records]);
    }
    public function deleteComment($id=null){
        $remove = Comment::findOrFail($id);
        $remove->delete();
        return redirect()->back();
    }
}
