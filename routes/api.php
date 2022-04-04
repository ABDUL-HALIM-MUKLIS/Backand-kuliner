<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Menu\ListMenuController;
use App\Http\Controllers\Api\Menu\ShowMenuController;
use App\Http\Controllers\Api\Place\ListPlaceController;
use App\Http\Controllers\Api\Place\ShowPlaceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/place', ListPlaceController::class)->name('api.place.list');
Route::get('/place/{place}', ShowPlaceController::class)->name('api.place.show');
Route::get('/place/{place}/menu', ListMenuController::class)->name('api.place.menu.list');
Route::get('/place/{place:id}/menu/{menu:id}', ShowMenuController::class)->name('api.place.menu.show');
