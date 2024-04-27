<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;

// Route::resource('users', UserController::class);
// Route::resource('groups', GroupController::class);

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/user', function () {
//     return view('users');
// });
// Route::get('/users',[UserController::class,'index']);
// Route::apiResource('users', UserController::class);
// Route::apiResource('groups', GroupController::class);
Route::post('/users', [UserController::class, 'UserController@store']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

