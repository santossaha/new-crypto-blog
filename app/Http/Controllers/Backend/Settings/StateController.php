<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\Countries;
use App\Models\States;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\EntrustFacade as Entrust;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    public function index(){
        return view('Backend.Settings.State.All');
    }

    public function datatable(){
        $query = States::select('states.id','states.country_id','states.name')->with('getCountry');
        return DataTables::eloquent($query)
            ->addColumn('Country', function (States $user) {
                return $user->getCountry->name;
            })
            ->addColumn('action', function ($data) {
                $url_update = route('editState', ['id' => $data->id]);
                $url_delete = route('deleteState', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit State" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                if(Entrust::can('delete-state')) {
                    $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete state: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                }
                return $edit;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function add(){
        $countries = Countries::select('id','name')->get();
        return view('Backend.Settings.State.Add',['countries'=>$countries]);
    }

    public function save(Request $request){
        $this->validate($request, [
            'country_id' => 'required',
            'name' => 'required',
        ]);

        $country_id = $request->get('country_id');
        $name = $request->get('name');
        $save = new States();
        $save->country_id = $country_id;
        $save->name = $name;
        $save->save();

        Session::flash('success', "State has been created");
        return redirect()->back();
    }

    public function edit($id=null){
        $record = States::findOrFail($id);
        $countries = Countries::select('id','name')->get();
        return view('Backend.Settings.State.Edit',['ID'=>$id,'record'=>$record,'countries'=>$countries]);
    }

    public function update(Request $request, $id){
        $update = States::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'country_id' => 'required',
        ]);
        $name = $request->get('name');
        $country_id = $request->get('country_id');

        $update->name = $name;
        $update->country_id = $country_id;
        $update->save();

        Session::flash('success', "State has been updated");
        return redirect()->back();
    }

    public function delete($id=null){
        $Remove = States::findOrFail($id);
        $Remove->delete();
        Session::flash('success', "State has been deleted");
        return redirect()->back();
    }

    public function stateOptions(Request $request){
        $data = [];
        $this->validate($request, [
            'q' => 'required',
        ]);
        $q = $request->get('q');
        $abbreviations = States::select('id','name','country_code')->where('name','like',"%$q%")->orWhere('country_code','like',"%$q%")->get();
        foreach ($abbreviations as $abbreviation){
            $data[] = [
                'id'=>$abbreviation->id,
                'name'=>$abbreviation->name,
                'country_code'=>$abbreviation->country_code
            ];
        }
        echo json_encode($data);
    }

    public function countryWiseStateOptions(Request $request,$CountryID=null){
        if($CountryID==null){
            $all_state = States::select('id','name')->get();
        }else{
            $all_state = States::select('id','name')->where('country_id',$CountryID)->get();
        }
        echo json_encode($all_state);
    }
}

