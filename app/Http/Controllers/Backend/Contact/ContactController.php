<?php

namespace App\Http\Controllers\Backend\Contact;

use App\Http\Controllers\Controller;
use App\Models\ContactUsModel;
use App\Models\ContractForm;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function allContact(){
        return view('Backend.Contact.All');
    }
    public function allContactDatabase(){
        $query = ContactUsModel::select('id','first_name','email','last_name','phone_number','address');
        return DataTables::eloquent($query)
            // ->addColumn('action', function ($data) {
            //     $url_update = route('viewContact', ['id' => $data->id]);
            //     $url_delete = route('deleteContact', ['id' => $data->id]);
            //     $edit = '<a class="label label-primary" data-title="Edit About us Content" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-eye" aria-hidden="true"></i> Edit </a>';
            //     $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete Contact us Content: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
            //     return $edit;
            // })
            ->rawColumns(['id'])
            ->toJson();
    }
    public function viewContact($id=null){
        $records = ContactUsModel::findOrFail($id);
        return view('Backend.Contact.Edit',[
            'records'=>$records,
        ]);
    }
    public function deleteContact($id=null){
        $remove = ContactUsModel::findOrFail($id);
        $remove->delete();
        return redirect()->back();
    }

}
