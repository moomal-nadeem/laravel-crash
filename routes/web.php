<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EmployeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// $info = "moomal nadeem";
// $info= Str::of($info)->ucfirst($info)->camel($info)->replaceLast("Nadeem", "Abida",$info)->replaceFirst("Moomal", "Nimra",$info);


// $info= Str::ucfirst($info);
// echo $info;

// $info= Str::camel($info);
// echo $info;
// $info= Str::replaceLast("Nadeem", "Abida",$info);
// echo $info;
// $info= Str::replaceFirst("Moomal", "Nimra",$info);
// echo $info;
Route::get('/checkDbCon', function () {
    try {
        DB::connection()->getPdo();
        if (DB::connection()->getDatabaseName()) {
            return "Database connection is successful.";
        } else {
            return "Database does not exist.";
        }
    } catch (\Exception $e) {
        return "Database connection could not be established: " . $e->getMessage();
    }
});


Route::get('/', function () {
    return view('welcome');
});
Route::get('/test/{name}', function ($name) {
    echo $name;
    return view('test', ['name'=>$name]);
});

// Route::get('/show',[UserController::class, "show"]);

// Route::delete('/deleteUser',[UserController::class, "deleteUser"]);
// Route::put('/editUser',[UserController::class, "editUser"]);
// Route::view('/test','test');

// Route::get('/vueReturn',[UserController::class, "vueReturn"]);


// Route::post('/addUser',[UserController::class, "addUser"]);
// Route::get('/show',[UserController::class, "show"]);
// Route::view('/signup','user')->middleware('routedScore');
// Route::view('/noaccess','noaccess');

Route::post('/addUser',[UserController::class, "addUser"]);
Route::get('/login', function () {
    if(session()->has('email')){
        return redirect('dashboards');
    }
    return redirect('login');
    
});
Route::view('/dashboards','dashboards');
//Delete session
Route::get('/logout', function () {
    if (session()->has('email')) {
        session()->pull('email', null);
        session()->flash('message', 'You have been successfully logged out.');
    }
    return view('/login');
});




// Route::get('/localization/{locale}', function ($locale) {
//     App::setlocale($locale);

// });




Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/newproduct', function () {
    return view('newproduct');
});

// Route::get('/product', 'product');

Route::post('/addData',[ProductController::class, "addData"]);
// Route::put('/editData',[ProductController::class, "editData"]);
Route::delete('deleteData/{id}', [ProductController::class, 'deleteData'])->name('deleteData');

// Route::delete('/deleteData/{id}',[ProductController::class, "deleteData"]);
Route::get('/product',[ProductController::class, "listDataPage"]);
Route::get('/products/{key}', [ProductController::class, 'productKey'])->name('products.key');
// Route::get('/product',[ProductController::class, "listData"]);
Route::get('edit/{id}',[ProductController::class, "byIdData"]);
Route::post('edit', [ProductController::class, 'editData'])->name('editData');
// Route::get('/products/{id}/byIdData', [ProductController::class, 'byIdData'])->name('products.byIdData');
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');













Route::get('/team', function () {
    return view('team');
})->name('team');
Route::get('/operations',[TeamController::class, "operations"]);
// Route::get('/findByRelation',[EmployeeController::class, "findByRelation"]);
Route::get('/findByRelation',[TeamController::class, "findByRelation"]);
Route::get('/jionData',[EmployeeController::class, "jionData"]);


Route::group(['middleware'=>['groupScore']],function(){
    Route::view('/dashboard','dashboard');
    // Route::view('/logout','logout');
});