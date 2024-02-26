<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'img',
        
    ];


    function getNameAttribute($value){
         return ucFirst($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = 'New ' . $value;
    }
    

    
}
