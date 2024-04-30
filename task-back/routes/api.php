<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('users', UserController::class);
Route::apiResource('groups', GroupController::class);
Route::post('/usersAdd', [UserController::class, 'store']);
Route::get('/usersView', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/groups/delete/{id}', [GroupController::class, 'destroy']);
Route::post('/groupsAdd', [GroupController::class, 'store']);
Route::get('/groupsView', [GroupController::class, 'index']);
Route::get('/groups/{id}', [GroupController::class, 'show']);
Route::post('/groups', [GroupController::class, 'store']);
Route::put('/groups/{id}', [GroupController::class, 'update']);
Route::delete('/groups/delete/{id}', [GroupController::class, 'destroy']);

