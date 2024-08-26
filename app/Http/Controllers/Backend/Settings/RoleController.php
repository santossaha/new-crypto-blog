<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index(){
        $allRole = Role::where('id','>',1)->orderBy('id','desc')->get();
        $data = [];
        $allPermissionGroups = Permission::select('group_name')->where('id','>',1)->where('group_name','!=','Permission')->groupBy('group_name')->get();
        foreach ($allPermissionGroups as $group){
            $permissions = Permission::where('group_name',$group->group_name)->get();
            foreach ($permissions as $permission){
                $data[$group->group_name][] = $permission;
            }
        }
        return view('Backend.Settings.Role.All',['AllRoles'=>$allRole, 'permissions'=> $data]);
    }

    public function saveRole(Request $request){
        $this->validate($request, [
            'role_name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $role_name = $request->get('role_name');
        $display_name = $request->get('display_name');
        $description = $request->get('description');

        $Role = new Role();
        $Role->name = $role_name;
        $Role->display_name = $display_name;
        $Role->description = $description;
        $Role->save();

        $permissions = $request->get('permissions');
        foreach ($permissions as $permission){
            $Role->attachPermission($permission);
        }
        Session::flash('success', "Role has been created successfully");
        return redirect()->back();
    }

    public function editRole($id=null){
        $Role = Role::findOrFail($id);
        $isAccessbackend = PermissionRole::where('role_id',$id)->where('permission_id',1)->first();
        $alllowBackend = empty($isAccessbackend) ? false : true;
        $allRole = Role::where('id','>',1)->orderBy('id','desc')->get();
        $data = [];
        $allPermissionGroups = Permission::select('group_name')->where('id','>',1)->where('group_name','!=','Permission')->groupBy('group_name')->get();
        foreach ($allPermissionGroups as $group){
            $permissions = Permission::where('group_name',$group->group_name)->get();
            foreach ($permissions as $permission){
                $checkPermission = PermissionRole::where('permission_id',$permission->id)->where('role_id',$Role->id)->count();
                $data[$group->group_name][] = [
                    'id'=>$permission->id,
                    'group_name'=>$permission->group_name,
                    'name'=>$permission->name,
                    'display_name'=>$permission->display_name,
                    'description'=>$permission->description,
                    'count'=>$checkPermission,
                ];
            }
        }
        return view('Backend.Settings.Role.Edit',['ID'=>$id,'Role'=>$Role, 'AllRoles'=>$allRole, 'permissions'=> $data, 'alllowBackend'=>$alllowBackend]);
    }

    public function updateRole(Request $request, $id){
        $Role = Role::findOrFail($id);
        $this->validate($request, [
            'role_name' => 'required|unique:roles,name,'.$id.',id',
            'display_name' => 'required',
            'description' => 'required',
        ]);
        $role_name = $request->get('role_name');
        $display_name = $request->get('display_name');
        $description = $request->get('description');
        $SelectedPermissions = $request->get('permissions');
        if($request->has('allow_backend') && !empty($request->get('allow_backend'))){
            $findPermission = PermissionRole::where('permission_id',$request->get('allow_backend'))->where('role_id',$id)->count();
            if(empty($findPermission)){
                $Role->attachPermission($request->get('allow_backend'));
            }
        }else{
            $Role->detachPermission(1);
        }
        $allPermission = Permission::select('id')->where('id','>',1)->where('group_name','!=','Permission')->get();
        foreach ($allPermission as $permission){
            if(is_array($SelectedPermissions) && in_array($permission->id,$SelectedPermissions)){ //selected
                $checkPermission = PermissionRole::where('permission_id',$permission->id)->where('role_id',$Role->id)->count();
                if(empty($checkPermission)) {
                    $Role->attachPermission($permission);
                }
            }else{
                $checkPermission = PermissionRole::where('permission_id',$permission->id)->where('role_id',$Role->id)->count();
                if(!empty($checkPermission)) {
                    $Role->detachPermission($permission);
                }
            }
        }

        $Role->name = $role_name;
        $Role->display_name = $display_name;
        $Role->description = $description;
        $Role->save();

        Session::flash('success', "Role has been updated successfully");
        return redirect()->back();
    }

    public function deleteRole($id=null){
        $Role = Role::findOrFail($id);
        $Role->delete();
        $deletePermissionRole = PermissionRole::where('role_id',$id)->delete();
        Session::flash('success', "Role has been deleted successfully");
        return redirect()->back();
    }



}
