<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use SoftDeletes;

    //  use EntrustUserTrait { restore as private restoreA; }
    // use SoftDeletes { restore as private restoreB; }


    use SoftDeletes, EntrustUserTrait {
        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::restore as entrustRestore;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $visible = [
                'id','name','email','mobile','profile_photo','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // public function restore()
    // {
    //     $this->restoreA();
    //     $this->restoreB();
    // }


    public function restore()
    {
        // Call the SoftDeletes restore method
        $this->entrustRestore();
    }

    public function newToken(){
        return Str::random(60);
    }

    public function getProfilePhotoAttribute($name){
        if(file_exists(public_path().'/uploads/profilePhoto/'.$name)){
            return [
                'name'=>$name,
                'path'=>asset('uploads/profilePhoto/'.$name),
            ];
        }else{
            return [
                'name'=>'avatar.png',
                'path'=>asset('uploads/profilePhoto/avatar.png'),
            ];
        }
    }

}
