<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function index(){
        $allPermission = Permission::where('id','>',1)->orderBy('id','asc')->paginate(10);
        $allPermissionGroups = Permission::select('group_name')->where('id','>',1)->groupBy('group_name')->get();
        return view('Backend.Settings.Permission.All',['AllPermissions'=>$allPermission,'allPermissionGroups'=>$allPermissionGroups]);
    }

    public function savePermission(Request $request){
        $this->validate($request, [
            'group_name' => 'required',
            'permission_name' => 'required|unique:permissions,name',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $group_name = empty($request->get('group_name')) ? $request->get('new_group_name') : $request->get('group_name');
        $permission_name = $request->get('permission_name');
        $display_name = $request->get('display_name');
        $description = $request->get('description');

        $Permission = new Permission();
        $Permission->group_name = $group_name;
        $Permission->name = $permission_name;
        $Permission->display_name = $display_name;
        $Permission->description = $description;
        $Permission->save();

        Session::flash('success', "New Permission has been created successfully");
        return redirect()->back();
    }

    public function editPermission($id=null){
        $Permission = Permission::findOrFail($id);
        $allPermissionGroups = Permission::select('group_name')->where('id','>',1)->groupBy('group_name')->get();
        return view('Backend.Settings.Permission.Edit',['ID'=>$id,'Permission'=>$Permission, 'allPermissionGroups'=>$allPermissionGroups]);
    }

    public function updatePermission(Request $request, $id){
        $Permission = Permission::findOrFail($id);
        $this->validate($request, [
            'group_name' => 'required',
            'permission_name' => 'required|unique:permissions,name,'.$id.',id',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $group_name = empty($request->get('group_name')) ? $request->get('new_group_name') : $request->get('group_name');
        $permission_name = $request->get('permission_name');
        $display_name = $request->get('display_name');
        $description = $request->get('description');

        $Permission->group_name = $group_name;
        $Permission->name = $permission_name;
        $Permission->display_name = $display_name;
        $Permission->description = $description;
        $Permission->save();

        Session::flash('success', "Permission has been updated successfully");
        return redirect()->back();
    }

    public function deletePermission($id=null){
        $Permission = Permission::findOrFail($id);
        $Permission->delete();
        Session::flash('success', "Permission has been deleted successfully");
        return redirect()->back();
    }
}
