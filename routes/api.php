<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Menu\ListMenuController;
use App\Http\Controllers\Api\Menu\ShowMenuController;
use App\Http\Controllers\Api\Place\ListPlaceController;
use App\Http\Controllers\Api\Place\ShowPlaceController;
use App\Http\Controllers\Api\Place\SearchPlaceController;
use App\Http\Controllers\Api\User\FavoritPlaceController;
use App\Http\Controllers\Api\Place\RelatedPlaceController;
use App\Http\Controllers\Api\SubDistrict\ListSubDistrictController;
use App\Http\Controllers\Api\SubDistrict\ShowSubDistrictController;
use App\Http\Controllers\Api\User\ListFavoritByUserPlaceController;
use App\Http\Controllers\Api\SubDistrict\ListPlaceBySubDisController;

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

//route login
Route::post('/login', LoginController::class);

//route post register user
Route::post('/register', RegisterController::class);

Route::get('/sub-district', ListSubDistrictController::class)->name('api.sub-district.list');
Route::get('/sub-district/{subDistrict}', ShowSubDistrictController::class)->name('api.sub-district.show');
Route::get('/sub-district/{subDistrict}/place', ListPlaceBySubDisController::class)->name('api.sub-district.place.list');

Route::get('/place', ListPlaceController::class)->name('api.place.list');
Route::get('/place/search', SearchPlaceController::class)->name('api.place.search');
Route::get('/place/{place}', ShowPlaceController::class)->name('api.place.show');
Route::get('/place/{place}/related', RelatedPlaceController::class)->name('api.place.related');
Route::get('/place/{place}/menu', ListMenuController::class)->name('api.place.menu.list');
Route::get('/place/{place:id}/menu/{menu:id}', ShowMenuController::class)->name('api.place.menu.show');

//route user favorite place
Route::post('/user/place/{place}/favorit', FavoritPlaceController::class)->name('api.user.place.favorit')->middleware('auth:sanctum');
Route::get('/user/place', ListFavoritByUserPlaceController::class)->name('api.user.place.list')->middleware('auth:sanctum');

