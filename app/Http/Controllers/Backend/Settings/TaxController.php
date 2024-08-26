<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\TaxSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Zizaco\Entrust\EntrustFacade as Entrust;

class TaxController extends Controller
{
    public function index(){
        return view('Backend.Settings.Tax.All');
    }

    public function datatable(){
        $query = TaxSetting::select('id','name','tax');
        return DataTables::eloquent($query)
            ->addColumn('action', function ($data) {
                $url_update = route('editTax', ['id' => $data->id]);
                $url_delete = route('deleteTax', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit Tax" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                if(Entrust::can('delete-tax')) {
                    $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete tax: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                }
                return $edit;
            })
            ->rawColumns(['action'])
            ->toJson();
    }



    public function addTax(){
        return view('Backend.Settings.Tax.Add');
    }

    public function saveTax(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'tax' => 'required|numeric',
        ]);

        $name = $request->get('name');
        $tax = $request->get('tax');

        $save = new TaxSetting();
        $save->name = $name;
        $save->tax = $tax;
        $save->save();

        Session::flash('success', "Tax has been created");
        return redirect()->back();
    }

    public function editTax($id=null){
        $record = TaxSetting::findOrFail($id);
        return view('Backend.Settings.Tax.Edit',['ID'=>$id,'record'=>$record]);
    }

    public function updateTax(Request $request, $id){
        $update = TaxSetting::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'tax' => 'required|numeric'
        ]);
        $name = $request->get('name');
        $tax = $request->get('tax');

        $update->name = $name;
        $update->tax = $tax;
        $update->save();

        Session::flash('success', "Tax has been updated");
        return redirect()->back();
    }

    public function deleteTax($id=null){
        $Remove = TaxSetting::findOrFail($id);
        $Remove->delete();
        Session::flash('success', "Tax has been deleted");
        return redirect()->back();
    }
}
