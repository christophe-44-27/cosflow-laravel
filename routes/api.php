<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('projects')->middleware('auth:api')->group(function(){
    Route::get('/', 'CosProjectController@index');
    Route::get('/details/{project}', 'CosProjectController@show');
    Route::post('/store', 'CosProjectController@store');
    Route::put('/update/{project}', 'CosProjectController@update');
    Route::delete('/delete/{project}', 'CosProjectController@delete');
});

Route::prefix('projects/elements')->middleware('auth:api')->group(function(){
    Route::get('/by-project/{project}', 'CosProjectElementController@listByProject');
    Route::get('/details/{projectElement}', 'CosProjectElementController@show');
    Route::post('/store/{project}', 'CosProjectElementController@store');
    Route::put('/update/{projectElement}', 'CosProjectElementController@update');
    Route::delete('/delete/{projectElement}', 'CosProjectElementController@delete');
});

Route::prefix('groups')->middleware('auth:api')->group(function(){
    Route::get('/', 'GroupController@listGroup')->name('group.index');
    Route::get('/details/{group}', 'GroupController@show')->name('group.show');
    Route::post('/store', 'GroupController@store')->name('group.store');
    Route::put('/update/{group}', 'GroupController@update')->name('group.update');
    Route::post('/{group}/attach/{project}', 'GroupController@attachProject')->name('group.attach_project');
    Route::post('/{group}/detach/{project}', 'GroupController@detach')->name('group.delete');
    Route::post('/join/{code}', 'GroupController@join')->name('group.join');
});

Route::prefix('user')->middleware('auth:api')->group(function() {
    Route::post('/profile', 'ProfileController@displayProfile')->name('display_profile');
});
