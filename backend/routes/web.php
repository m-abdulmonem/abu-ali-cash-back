<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Position;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {


    $visitors =\App\Models\Visitor::paginate();




    foreach (super_unique($visitors,"page") as $visitor){
        echo (count(\App\Models\Visitor::where("page","=",$visitor->page)->get()->unique()));
    }

//    dd(Location::get("41.233.0.206"));
//    $role = Role::findOrCreate('writer');
//    $permission = Permission::findOrCreate('edit articles');
//    $role->givePermissionTo($permission);
//    $permission->assignRole($role);
//    dd(User::find(2)->assignRole('writer')->givePermissionTo('edit articles'));
});

Route::get("roles",function (){
    return "Roles Page";
})->middleware(['role:writer']);




Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'ma-admin'],function (){
    Auth::routes([
        'register' => false,
        'verify' => false
    ]);
});
