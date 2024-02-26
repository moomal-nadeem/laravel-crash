<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Team;
class TeamController extends Controller
{
    //
//    public function operations(){
//         return DB::table('teams')->sum('id');   
//         return DB::table('teams')->max('id');   
//         return DB::table('teams')->min('id'); 
//         return DB::table('teams')->avg('id'); 
//     }

public function findByRelation(){
      return Team::find(1)->orgData;
}
}
