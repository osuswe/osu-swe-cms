<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Http\Controllers\Admin\UsersController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admin/events', 'Admin\\EventsController');
Route::resource('admin/users', 'Admin\\UsersController');
Route::resource('admin/links', 'Admin\\LinksController');
Route::resource('admin/attendance', 'Admin\\AttendanceController');

//use cors middleware to make cross origin requests
Route::post('/admin/storeUser',['middleware'=>'cors',function(\Illuminate\Http\Request $r){

    $userC=new UsersController();
    $userC->store($r);

}]);