<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class NewlyAdd extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        $owner = Role::find(1);
        $admin = Role::find(2);

        $permissions = array(
          /*  //Zajex Price
            [
                'group_name'=>'Zajex Price',
                'name'=>'view-zajex-charge',
                'display_name'=>'View Zajex Charge',
                'description'=>'Users who has this permission can update Zajex Charge details'
            ],
            [
                'group_name'=>'Zajex Price',
                'name'=>'add-zajex-charge',
                'display_name'=>'Add Zajex Price',
                'description'=>'Users who has this permission can Add Zajex Charge Price'
            ],

            //Currency
            [
                'group_name'=>'Currency',
                'name'=>'view-currency',
                'display_name'=>'View Currency',
                'description'=>'Users who has this permission can view currency lists'
            ],
            [
                'group_name'=>'Currency',
                'name'=>'add-currency',
                'display_name'=>'Add Currency',
                'description'=>'Users who has this permission can add new currency'
            ],*/
            //Oder Status
            /*[
                'group_name'=>'Order',
                'name'=>'view-order',
                'display_name'=>'View Order',
                'description'=>'Users who has this permission can view order lists'
            ],*/

            //Testimonial
           /* [
                'group_name'=>'Testimonial',
                'name'=>'view-testimonial',
                'display_name'=>'View Testimonial',
                'description'=>'Users who has this permission can view Testimonial'
            ],
            [
                'group_name'=>'Testimonial',
                'name'=>'add-testimonial',
                'display_name'=>'Add Testimonial',
                'description'=>'Users who has this permission can add media Testimonial'
            ],
            [
                'group_name'=>'Testimonial',
                'name'=>'update-testimonial',
                'display_name'=>'Edit Testimonial',
                'description'=>'Users who has this permission can update Testimonial'
            ],
            [
                'group_name'=>'Testimonial',
                'name'=>'delete-testimonial',
                'display_name'=>'Delete Testimonial',
                'description'=>'Users who has this permission can delete Testimonial'
            ],*/

            //Brand
            /*[
                'group_name'=>'Brand',
                'name'=>'view-brand',
                'display_name'=>'View Brand',
                'description'=>'Users who has this permission can view Brand'
            ],
            [
                'group_name'=>'Brand',
                'name'=>'add-brand',
                'display_name'=>'Add Brand',
                'description'=>'Users who has this permission can add media Brand'
            ],
            [
                'group_name'=>'Brand',
                'name'=>'update-brand',
                'display_name'=>'Edit Brand',
                'description'=>'Users who has this permission can update Brand'
            ],
            [
                'group_name'=>'Brand',
                'name'=>'delete-brand',
                'display_name'=>'Delete Brand',
                'description'=>'Users who has this permission can delete Brand'
            ],*/

           /* //slider
            [
                'group_name'=>'Slider',
                'name'=>'view-slider',
                'display_name'=>'View Slider',
                'description'=>'Users who has this permission can view Slider'
            ],
            [
                'group_name'=>'Slider',
                'name'=>'update-slider',
                'display_name'=>'Edit Brand',
                'description'=>'Users who has this permission can update Slider'
            ],*/


            //How it Work
           /* [
                'group_name'=>'How It Work',
                'name'=>'view-how-it-work',
                'display_name'=>'View How It Work',
                'description'=>'Users who has this permission can view How It Work'
            ],
            [
                'group_name'=>'How It Work',
                'name'=>'add-how-it-work',
                'display_name'=>'Add How It Work',
                'description'=>'Users who has this permission can add media How It Work'
            ],
            [
                'group_name'=>'How It Work',
                'name'=>'update-how-it-work',
                'display_name'=>'Edit How It Work',
                'description'=>'Users who has this permission can update How It Work'
            ],
            [
                'group_name'=>'How It Work',
                'name'=>'delete-how-it-work',
                'display_name'=>'Delete How It Work',
                'description'=>'Users who has this permission can delete How It Work'
            ],*/

            //Shopping
             /*[
              'group_name'=>'Shopping',
              'name'=>'view-shopping',
              'display_name'=>'View Shopping',
              'description'=>'Users who has this permission can view shopping'
            ],
            [
              'group_name'=>'Shopping',
              'name'=>'add-shopping',
              'display_name'=>'Add Shopping',
              'description'=>'Users who has this permission can add shopping'
            ],
            [
              'group_name'=>'Shopping',
              'name'=>'update-shopping',
              'display_name'=>'Update Shopping',
              'description'=>'Users who has this permission can update Shopping'
            ],*/

            //Shipping
           /* [
                'group_name'=>'Shipping',
                'name'=>'view-shipping',
                'display_name'=>'View shipping',
                'description'=>'Users who has this permission can view shipping'
            ],*/


                //Package
           /* [
                'group_name'=>'Package',
                'name'=>'view-package',
                'display_name'=>'View Package',
                'description'=>'Users who has this permission can view package'
            ],
            [
                'group_name'=>'Package',
                'name'=>'add-package',
                'display_name'=>'Add Package',
                'description'=>'Users who has this permission can add Package'
            ],*/



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
