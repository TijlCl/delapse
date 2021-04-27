<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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

Route::prefix('/v1')->group(function () {
    Route::post('/register', 'AuthController@register');

    Route::prefix('/auth')->middleware(['auth:api'])->group(function () {
        Route::get('/user', 'AuthController@user');
        Route::post('/logout', 'AuthController@logout');
    });


    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('chats', 'ChatController')->only(['show']);
        Route::post('chats/{chat}/send', 'ChatController@sendMessage');

        Route::resource('friends', 'FriendController')->only(['index']);
        Route::resource('achievements', 'AchievementController')->only(['index']);


        Route::resource('/events', 'EventController')->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::get('users/getByUsername', 'UserController@getByUsername');
        Route::resource('users', 'UserController')->only(['show']);
    });
});

