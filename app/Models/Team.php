<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
 
function orgData(){
    return $this->hasMany('App\Models\Organization');
}

function orgData1(){
    return $this->hasOne('App\Models\Organization');
}
}
