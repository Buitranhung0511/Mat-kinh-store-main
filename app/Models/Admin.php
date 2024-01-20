<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    public $timestamp = false; // set time to false
    protected $fillable =[
        'admin_email','admin_password','admin_name','admin_phone'
    ];

    protected $primaryKey = 'admin_id';
    protected $table = 'admin';

    public function roles(){
        return $this->belongsToMany('App\Models\Roles');
    }

    public function getAuthPassword()
    {
        return $this->admin_password;
    }
    
    public function hasAnyRole($roles){
        return null !== $this->roles()->whereIn('name',$roles)->first();
    }

    public function hasRole($roles){
        return null !== $this->roles()->where('name',$roles)->first();
    }

}
//
