<?php

use Illuminate\Http\Request;

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
Route::patch('admin/actions/{actions}/updateActiveAttribute', ['as'=> 'admin.actions.updateActiveAttribute', 'uses' => 'ActionAPIController@updateActiveAttribute']);


Route::patch('admin/users/{users}/actives', ['as'=> 'admin.users.actives', 'uses' => 'UserAPIController@actives']);
Route::patch('admin/posts/{posts}/actives', ['as'=> 'admin.posts.actives', 'uses' => 'PostAPIController@actives']);
Route::patch('admin/motels/{motels}/actives', ['as'=> 'admin.motels.actives', 'uses' => 'MotelAPIController@actives']);
Route::patch('admin/motels/{motels}/getDistrict', ['as'=> 'admin.motels.getDistrict', 'uses' => 'MotelAPIController@getDistrict']);
Route::patch('admin/motels/{motels}/getTown', ['as'=> 'admin.motels.getTown', 'uses' => 'MotelAPIController@getTown']);
Route::patch('admin/motels/{motels}/getStreet', ['as'=> 'admin.motels.getStreet', 'uses' => 'MotelAPIController@getStreet']);
Route::patch('admin/motels/{category}/getFieldsConfigCategory', ['as'=> 'admin.motels.getFieldsConfigCategory', 'uses' => 'MotelAPIController@getFieldsConfigCategory']);


Route::patch('admin/groups/{groups}/updateActiveAttribute', ['as'=> 'admin.groups.updateActiveAttribute', 'uses' => 'GroupAPIController@updateActiveAttribute']);

Route::post('admin/usermenu/syncUserMenuRelation', ['as'=> 'admin.usermenu.syncUserMenuRelation', 'uses' => 'UserMenuAPIController@syncUserMenuRelation']);

Route::post('admin/groups/syncGroupMenuRelation', ['as'=> 'admin.groups.syncGroupMenuRelation', 'uses' => 'GroupAPIController@syncGroupMenuRelation']);

