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
    return view('login');
});

Route::resource('admin/events', 'Admin\\EventsController');
Route::resource('admin/users', 'Admin\\UsersController');
Route::resource('admin/links', 'Admin\\LinksController');
Route::resource('admin/attendance', 'Admin\\AttendanceController');

Route::post('/admin/manage/login', function (\Illuminate\Http\Request $r) {
    $userC = new UsersController();
    $userC->cmsLogin($r);
});

Route::post('/admin/signup',function(\Illuminate\Http\Request $r){
    $userC = new UsersController();
    $userC->signup($r);
});

Route::post('/admin/storeUser',  function (\Illuminate\Http\Request $r) {
    $userC = new UsersController();
    $userC->store($r);
});

Route::post('/admin/login',  function (\Illuminate\Http\Request $r) {
    $userC = new UsersController();
    echo $userC->login($r);
});

Route::get('/admin/get/events/all',  function () {
    $eventsC = new \App\Http\Controllers\Admin\EventsController();
    echo $eventsC->all();
});

Route::post('/admin/get/userProfile',  function (\Illuminate\Http\Request $r) {
    $userC = new UsersController();
    echo $userC->getProfileInfo($r->username);
});

Route::post('/admin/get/allAttendees',  function (\Illuminate\Http\Request $r) {
    $attC = new \App\Http\Controllers\Admin\AttendanceController();
    echo $attC->getAllAttendees($r->eventId);
});


Route::post('/admin/page/userSearch/',  function (\Illuminate\Http\Request $r) {
    $userC = new UsersController();
    $result = $userC->getProfileInfo($r->userInput);
    $attC = new \App\Http\Controllers\Admin\AttendanceController();
    $events = $attC->eventsAttended($result->id);
    return view('admin/attendance/userSearch', array('userInfo' => $result, 'events' => $events));

});

Route::post('admin/get/hasAttended',  function (\Illuminate\Http\Request $r) {
    $attC = new \App\Http\Controllers\Admin\AttendanceController();
    echo $attC->hasAttended($r);
});

Route::post('/admin/add/attendanceRecord',  function (\Illuminate\Http\Request $r) {
    $attC = new \App\Http\Controllers\Admin\AttendanceController();
    echo $attC->save_attendance_record($r);
});

Route::post("/admin/update/profile", "Admin\\UsersController@changeProfile");

Route::get('/admin/get/users',  function () {
    $userC = new UsersController();
    echo $userC->getUsers();
});

Route::get('/admin/get/links',  function () {
    $linksC = new \App\Http\Controllers\Admin\LinksController();
    echo $linksC->all();
});