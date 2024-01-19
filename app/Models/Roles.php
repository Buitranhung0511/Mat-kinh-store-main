<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamp = false; // set time to false
    protected $fillable =[
       'name'
    ];

    protected $primaryKey = 'id_roles';
    protected $table = 'roles';

    public function admin(){
        return $this->belongsToMany('App\Admin');
    }
}
//
