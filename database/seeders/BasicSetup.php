<?php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class BasicSetup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Basic Roll
        $owner = new Role();
        $owner->name         = 'Super Admin';
        $owner->display_name = 'Project Owner';
        $owner->description  = 'User is the owner/developer of a the project';
        $owner->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Project Admin';
        $admin->description  = 'User is the admin of the project';
        $admin->save();

        //Add User With Role
        $SuperAdmin = New User();
        $SuperAdmin->name = "Super Admin";
        $SuperAdmin->email = "superadmin@gmail.com";
        $SuperAdmin->password = bcrypt("12345");
        $SuperAdmin->profile_photo = 'avatar.png';
        $SuperAdmin->api_token = $SuperAdmin->newToken();
        $SuperAdmin->save();
        $SuperAdmin->attachRole($owner);

        $Admin = New User();
        $Admin->name = "Admin";
        $Admin->email = "admin@gmail.com";
        $Admin->password = bcrypt("12345");
        $Admin->profile_photo = 'avatar.png';
        $Admin->api_token = $Admin->newToken();
        $Admin->save();
        $Admin->attachRole($admin);

        $permissions = array(
                // Access Panel
            [
                'group_name'=>'Access Backend Panel',
                'name'=>'access-panel',
                'display_name'=>'Access Panel',
                'description'=>'Users who has this permission can access the backhand panel'
            ],
                //General Setting
            [
                'group_name'=>'General Settings',
                'name'=>'view-general-setting',
                'display_name'=>'View General Setting',
                'description'=>'Users who has this permission can view general setting'
            ],
            [
                'group_name'=>'General Settings',
                'name'=>'update-general-setting',
                'display_name'=>'Update General Setting',
                'description'=>'Users who has this permission can update general setting'
            ],
                //Company Setting
            [
                'group_name'=>'Company Settings',
                'name'=>'view-company-setting',
                'display_name'=>'View Company Setting',
                'description'=>'Users who has this permission can view company setting'
            ],
            [
                'group_name'=>'Company Settings',
                'name'=>'update-company-setting',
                'display_name'=>'Update Company Setting',
                'description'=>'Users who has this permission can update company setting'
            ],
                //Email Setting
            [
                'group_name'=>'Email Settings',
                'name'=>'view-email-setting',
                'display_name'=>'View Email Setting',
                'description'=>'Users who has this permission can view email setting'
            ],
            [
                'group_name'=>'Email Settings',
                'name'=>'update-email-setting',
                'display_name'=>'Update Email Setting',
                'description'=>'Users who has this permission can update email setting'
            ],

                //Country
            [
                'group_name'=>'Country',
                'name'=>'view-country',
                'display_name'=>'View Country',
                'description'=>'Users who has this permission can view country'
            ],
            [
                'group_name'=>'Country',
                'name'=>'add-country',
                'display_name'=>'Add Country',
                'description'=>'Users who has this permission can add country'
            ],
            [
                'group_name'=>'Country',
                'name'=>'update-country',
                'display_name'=>'Update Country',
                'description'=>'Users who has this permission can update country'
            ],
            [
                'group_name'=>'Country',
                'name'=>'delete-country',
                'display_name'=>'Delete Country',
                'description'=>'Users who has this permission can delete country'
            ],
                //State
            [
                'group_name'=>'State',
                'name'=>'view-state',
                'display_name'=>'View State',
                'description'=>'Users who has this permission can view state'
            ],
            [
                'group_name'=>'State',
                'name'=>'add-state',
                'display_name'=>'Add State',
                'description'=>'Users who has this permission can add state'
            ],
            [
                'group_name'=>'State',
                'name'=>'update-state',
                'display_name'=>'Update State',
                'description'=>'Users who has this permission can update state'
            ],
            [
                'group_name'=>'State',
                'name'=>'delete-state',
                'display_name'=>'Delete State',
                'description'=>'Users who has this permission can delete state'
            ],

                //Role
            [
                'group_name'=>'Role',
                'name'=>'view-role',
                'display_name'=>'View Role',
                'description'=>'Users who has this permission can view roles'
            ],
            [
                'group_name'=>'Role',
                'name'=>'add-role',
                'display_name'=>'Add Role',
                'description'=>'Users who has this permission can add roles'
            ],
            [
                'group_name'=>'Role',
                'name'=>'update-role',
                'display_name'=>'Update Role',
                'description'=>'Users who has this permission can update roles'
            ],
            [
                'group_name'=>'Role',
                'name'=>'delete-role',
                'display_name'=>'Delete Role',
                'description'=>'Users who has this permission can delete roles'
            ],
                //Permission
            [
                'group_name'=>'Permission',
                'name'=>'view-permission',
                'display_name'=>'View Permission',
                'description'=>'Users who has this permission can view permission'
            ],
            [
                'group_name'=>'Permission',
                'name'=>'add-permission',
                'display_name'=>'Add Permission',
                'description'=>'Users who has this permission can add permission'
            ],
            [
                'group_name'=>'Permission',
                'name'=>'update-permission',
                'display_name'=>'Update Permission',
                'description'=>'Users who has this permission can update permission'
            ],
            [
                'group_name'=>'Permission',
                'name'=>'delete-permission',
                'display_name'=>'Delete Permission',
                'description'=>'Users who has this permission can delete permission'
            ],
                //Taxes
            [
                'group_name'=>'Taxes',
                'name'=>'view-tax',
                'display_name'=>'View Taxes',
                'description'=>'Users who has this permission can view taxes'
            ],
            [
                'group_name'=>'Taxes',
                'name'=>'add-tax',
                'display_name'=>'Add Taxes',
                'description'=>'Users who has this permission can add taxes'
            ],
            [
                'group_name'=>'Taxes',
                'name'=>'update-tax',
                'display_name'=>'Update Taxes',
                'description'=>'Users who has this permission can update taxes'
            ],
            [
                'group_name'=>'Taxes',
                'name'=>'delete-tax',
                'display_name'=>'Delete Taxes',
                'description'=>'Users who has this permission can delete taxes'
            ],
                //Users
            [
                'group_name'=>'Users',
                'name'=>'view-user',
                'display_name'=>'View Users',
                'description'=>'Users who has this permission can view user lists'
            ],
            [
                'group_name'=>'Users',
                'name'=>'add-user',
                'display_name'=>'Add User',
                'description'=>'Users who has this permission can add new user'
            ],
            [
                'group_name'=>'Users',
                'name'=>'update-user',
                'display_name'=>'Update User',
                'description'=>'Users who has this permission can update user details'
            ],
            [
                'group_name'=>'Users',
                'name'=>'delete-user',
                'display_name'=>'Delete User',
                'description'=>'Users who has this permission can delete user'
            ],
            //Social Links
            [
                'group_name'=>'Social Links',
                'name'=>'view-social-link',
                'display_name'=>'View Social Links',
                'description'=>'Users who has this permission can update user social links'
            ],
            [
                'group_name'=>'Social Links',
                'name'=>'update-social-link',
                'display_name'=>'Update Social Links',
                'description'=>'Users who has this permission can update social links'
            ],
        );

        foreach($permissions as $permission){
            $permissionID = Permission::create($permission);
            $owner->attachPermission($permissionID);

            if($permission['group_name'] !='Permission'){
                $admin->attachPermission($permissionID);
            }
        }

    }
}
