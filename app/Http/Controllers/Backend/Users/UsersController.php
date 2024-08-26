<?php

namespace App\Http\Controllers\Backend\Users;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\EntrustFacade as Entrust;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(){;
        return view('Backend.Users.All');
    }

    public function datatable(){
        $isDelete = Entrust::can('delete-user') ? true : false;
        $query = User::select('id','name','email','mobile','profile_photo','remember_token')->where('id','>',1);
        return DataTables::eloquent($query)
            ->editColumn('profile', function ($data) {
                $roles = '';
                foreach ($data['roles'] as $role){
                    $roles .= '<span class="label label-primary">'.$role['display_name'].'</span> &nbsp';
                }
                $content = '<div class="products-list">
                                <div class="product-img">
                                    <a class="magnific-image" href="'.$data->profile_photo['path'].'">
                                        <img src="'.$data->profile_photo['path'].'" alt="'.$data->name.'">
                                    </a>
                                </div>
                                <div class="product-info">
                                <a href="javascript:void(0);" data-title="Edit User" data-act="ajax-modal" data-append-id="AjaxModelContent"  data-action-url="'.route('editUser', ['id' => $data->id]).'" class="product-title">'.$data->name.'</a>
                                <span class="product-description">
                                      '.$roles.'
                                </span>
                              </div>
                            </div>';
                return $content;
            })
            ->addColumn('action', function ($data) use ($isDelete) {
                $url_update = route('editUser', ['id' => $data->id]);
                $url_delete = route('deleteUser', ['id' => $data->id]);
                $edit = '<a class="label label-primary" data-title="Edit User" data-act="ajax-modal" data-append-id="AjaxModelContent" data-action-url="'.$url_update.'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a>';
                if($isDelete) {
                    $edit .= '&nbsp<a href="' . $url_delete . '" class="label label-danger" data-confirm="Are you sure to delete user: <span class=&#034;label label-primary&#034;>' . $data->name . '</span>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </a>';
                }
                return $edit;
            })
            ->rawColumns(['profile','action'])
            ->toJson();
    }

    public function add(){
        $allRole = Role::where('id','>',1)->orderBy('id','desc')->get();
        return view('Backend.Users.Add',['Roles'=>$allRole]);
    }

    public function save(Request $request){
        $this->validate($request, [
            'roles'=> 'required',
            'name' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        $confirm_password = $request->get('confirm_password');
        $mobile = $request->get('mobile');
        $roles = $request->get('roles');

        if ($request->hasFile('profile_photo')) {
            $file            = $request->file('profile_photo');
            $destinationPath = '/uploads/profilePhoto/';
            $filename        = Str::random(10).'.'. $file->getClientOriginalExtension();
            $request->file('profile_photo')->move(public_path().$destinationPath, $filename);
            $profile_photo = $filename;
        }else{
            $profile_photo = 'avatar.png';
        }

        $User = new User();
        $User->name = $name;
        $User->email = $email;
        $User->password = bcrypt($confirm_password);
        $User->mobile = $mobile;
        $User->profile_photo = $profile_photo;
        $User->api_token = $User->newToken();
        $User->save();
        if(isset($User->id)){
            foreach ($roles as $role){
                $User->attachRole($role);
            }
        }
        Session::flash('success', "User has been created successfully");
        return redirect()->back();
    }

    public function edit($id)
    {
        try {
            $records = User::findOrFail($id);
            $allRole = Role::where('id','>',1)->orderBy('id','desc')->get();
            $userRole = $records->roles;
            return view('Backend.Users.Edit',['Roles'=>$allRole, 'ID'=>$id, 'UserRoles'=>$userRole, 'records'=>$records]);
        } catch (Exception $e) {
            return view('Backend.InvalidModalOperation');
        }
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'roles'=> 'required',
            'name' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|unique:users,email,'.$id.',id'
        ]);

        $name = $request->get('name');
        $email = $request->get('email');
        $mobile = $request->get('mobile');
        $roles = $request->get('roles');

        $User =  User::findOrFail($id);

        if ($request->hasFile('profile_photo')) {
            $file            = $request->file('profile_photo');
            $destinationPath = '/uploads/profilePhoto/';
            $filename        = Str::random(10).'.'. $file->getClientOriginalExtension();
            $request->file('profile_photo')->move(public_path().$destinationPath, $filename);
            $profile_photo = $filename;
        }else{
            $profile_photo = $User->profile_photo['name'];
        }
        $User->name = $name;
        $User->email = $email;
        $User->mobile = $mobile;
        $User->profile_photo = $profile_photo;
        $User->save();
        if(isset($User->id)){
            $User->detachRoles($User->roles);

            foreach ($roles as $role){
                $User->attachRole($role);
            }
        }
        Session::flash('success', "User has been updated");
        return redirect()->back();
    }

    public function delete($id=null){
        $Remove = User::findOrFail($id);
        $Remove->detachRoles($Remove->roles);
        $Remove->delete();
        Session::flash('success', "User has been deleted");
        return redirect()->back();
    }

}
