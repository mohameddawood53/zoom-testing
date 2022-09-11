<?php

use Illuminate\Support\Facades\Route;

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
//    return view('welcome');
  return  (new \App\Reposotiries\Meetings\Meeting(new \App\Reposotiries\Meetings\Zoom()))->createMeetingUser([
      'email' => "admin@admin.com",
      'name' => "mohamed",
      'last_name' => null,
  ]);

//    return  \App\Reposotiries\Meetings\Meeting::Init(new \App\Reposotiries\Meetings\Zoom())->createMeetingUser([
//        'email' => "admin@admin.com",
//        'name' => "mohamed",
//        'last_name' => null,
//    ]);
});
