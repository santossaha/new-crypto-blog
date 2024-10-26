<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\EntrustFacade as Entrust;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index(){
        return view('Backend.Settings.Country.All');
    }

    public function datatable(){
        $query = Countries::select('id','name','country_code');
        return DataTables::eloquent($query)
            ->addColumn('action', function ($data) {
                $url_update = route('editCountry', ['id' => $data->id]);
                $url_delete = route('deleteCountry', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit Country" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                if(Entrust::can('delete-country')) {
                    $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete country: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                }
                return $edit;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function add(){
        return view('Backend.Settings.Country.Add');
    }

    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'country_code' => 'required',
        ]);

        $name = $request->get('name');
        $country_code = $request->get('country_code');

        $save = new Countries();
        $save->name = $name;
        $save->country_code = $country_code;
        $save->save();

        Session::flash('success', "Country has been created");
        return redirect()->back();
    }

    public function edit($id=null){
        $record = Countries::findOrFail($id);
        return view('Backend.Settings.Country.Edit',['ID'=>$id,'record'=>$record]);
    }

    public function update(Request $request, $id){
        $update = Countries::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'country_code' => 'required',
        ]);
        $name = $request->get('name');
        $country_code = $request->get('country_code');

        $update->name = $name;
        $update->country_code = $country_code;
        $update->save();

        Session::flash('success', "Country has been updated");
        return redirect()->back();
    }

    public function delete($id=null){
        $Remove = Countries::findOrFail($id);
        $Remove->delete();
        Session::flash('success', "Country has been deleted");
        return redirect()->back();
    }

    public function countryOptions(Request $request){
        $data = [];
        $this->validate($request, [
            'q' => 'required',
        ]);
        $q = $request->get('q');
        $abbreviations = Countries::select('id','name','country_code')->where('name','like',"%$q%")->orWhere('country_code','like',"%$q%")->get();
        foreach ($abbreviations as $abbreviation){
            $data[] = [
                'id'=>$abbreviation->id,
                'name'=>$abbreviation->name,
                'country_code'=>$abbreviation->country_code
            ];
        }
        echo json_encode($data);
    }
}

