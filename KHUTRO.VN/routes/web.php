<?php

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
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index');


Route::get('admin/groups', ['as'=> 'admin.groups.index', 'uses' => 'GroupController@index']);
Route::post('admin/groups', ['as'=> 'admin.groups.store', 'uses' => 'GroupController@store']);
Route::get('admin/groups/create', ['as'=> 'admin.groups.create', 'uses' => 'GroupController@create']);
Route::put('admin/groups/{groups}', ['as'=> 'admin.groups.update', 'uses' => 'GroupController@update']);
Route::patch('admin/groups/{groups}', ['as'=> 'admin.groups.update', 'uses' => 'GroupController@update']);
Route::delete('admin/groups/{groups}', ['as'=> 'admin.groups.destroy', 'uses' => 'GroupController@destroy']);
Route::get('admin/groups/{groups}', ['as'=> 'admin.groups.show', 'uses' => 'GroupController@show']);
Route::get('admin/groups/{groups}/edit', ['as'=> 'admin.groups.edit', 'uses' => 'GroupController@edit']);
Route::get('admin/groups/{groups}/duplicate', ['as'=> 'admin.groups.duplicate', 'uses' => 'GroupController@duplicate']);
Route::post('admin/groups/export',['as'=>'admin.groups.export', 'uses'=>'GroupController@exportExcel']);
Route::get('admin/groups/active', ['as'=> 'admin.groups.active', 'uses' => 'GroupController@active']);
Route::post('admin/groups/common_action', ['as'=> 'admin.groups.common_action', 'uses' => 'GroupController@common_action']);


Route::get('admin/userGroups', ['as'=> 'admin.userGroups.index', 'uses' => 'UserGroupController@index']);
Route::post('admin/userGroups', ['as'=> 'admin.userGroups.store', 'uses' => 'UserGroupController@store']);
Route::get('admin/userGroups/create', ['as'=> 'admin.userGroups.create', 'uses' => 'UserGroupController@create']);
Route::put('admin/userGroups/{userGroups}', ['as'=> 'admin.userGroups.update', 'uses' => 'UserGroupController@update']);
Route::patch('admin/userGroups/{userGroups}', ['as'=> 'admin.userGroups.update', 'uses' => 'UserGroupController@update']);
Route::delete('admin/userGroups/{userGroups}', ['as'=> 'admin.userGroups.destroy', 'uses' => 'UserGroupController@destroy']);
Route::get('admin/userGroups/{userGroups}', ['as'=> 'admin.userGroups.show', 'uses' => 'UserGroupController@show']);
Route::get('admin/userGroups/{userGroups}/edit', ['as'=> 'admin.userGroups.edit', 'uses' => 'UserGroupController@edit']);


Route::get('admin/tables', ['as'=> 'admin.tables.index', 'uses' => 'TableController@index']);
Route::post('admin/tables', ['as'=> 'admin.tables.store', 'uses' => 'TableController@store']);
Route::get('admin/tables/create', ['as'=> 'admin.tables.create', 'uses' => 'TableController@create']);
Route::put('admin/tables/{tables}', ['as'=> 'admin.tables.update', 'uses' => 'TableController@update']);
Route::patch('admin/tables/{tables}', ['as'=> 'admin.tables.update', 'uses' => 'TableController@update']);
Route::delete('admin/tables/{tables}', ['as'=> 'admin.tables.destroy', 'uses' => 'TableController@destroy']);
Route::get('admin/tables/{tables}', ['as'=> 'admin.tables.show', 'uses' => 'TableController@show']);
Route::get('admin/tables/{tables}/edit', ['as'=> 'admin.tables.edit', 'uses' => 'TableController@edit']);
Route::post('admin/tables/export',['as'=>'admin.tables.export', 'uses'=>'TableController@exportExcel']);
Route::get('admin/tables/{tables}/duplicate', ['as'=> 'admin.tables.duplicate', 'uses' => 'TableController@duplicate']);


Route::get('admin/actions', ['as'=> 'admin.actions.index', 'uses' => 'ActionController@index']);
Route::post('admin/actions', ['as'=> 'admin.actions.store', 'uses' => 'ActionController@store']);
Route::get('admin/actions/create', ['as'=> 'admin.actions.create', 'uses' => 'ActionController@create']);
Route::put('admin/actions/{actions}', ['as'=> 'admin.actions.update', 'uses' => 'ActionController@update']);
Route::patch('admin/actions/{actions}', ['as'=> 'admin.actions.update', 'uses' => 'ActionController@update']);
Route::delete('admin/actions/{actions}', ['as'=> 'admin.actions.destroy', 'uses' => 'ActionController@destroy']);
Route::get('admin/actions/{actions}', ['as'=> 'admin.actions.show', 'uses' => 'ActionController@show']);
Route::get('admin/actions/{actions}/edit', ['as'=> 'admin.actions.edit', 'uses' => 'ActionController@edit']);
Route::get('admin/actions/{actions}/duplicate', ['as'=> 'admin.actions.duplicate', 'uses' => 'ActionController@duplicate']);
Route::get('admin/actions/active', ['as'=> 'admin.actions.active', 'uses' => 'ActionController@active']);
Route::post('admin/actions/common_action', ['as'=> 'admin.actions.common_action', 'uses' => 'ActionController@common_action']);


Route::get('admin/menus', ['as'=> 'admin.menus.index', 'uses' => 'MenuController@index']);
Route::post('admin/menus', ['as'=> 'admin.menus.store', 'uses' => 'MenuController@store']);
Route::get('admin/menus/create', ['as'=> 'admin.menus.create', 'uses' => 'MenuController@create']);
Route::put('admin/menus/{menus}', ['as'=> 'admin.menus.update', 'uses' => 'MenuController@update']);
Route::patch('admin/menus/{menus}', ['as'=> 'admin.menus.update', 'uses' => 'MenuController@update']);
Route::delete('admin/menus/{menus}', ['as'=> 'admin.menus.destroy', 'uses' => 'MenuController@destroy']);
Route::get('admin/menus/{menus}', ['as'=> 'admin.menus.show', 'uses' => 'MenuController@show']);
Route::get('admin/menus/{menus}/edit', ['as'=> 'admin.menus.edit', 'uses' => 'MenuController@edit']);




Route::get('admin/userMenus', ['as'=> 'admin.userMenus.index', 'uses' => 'UserMenuController@index']);
Route::post('admin/userMenus', ['as'=> 'admin.userMenus.store', 'uses' => 'UserMenuController@store']);
Route::get('admin/userMenus/create', ['as'=> 'admin.userMenus.create', 'uses' => 'UserMenuController@create']);
Route::put('admin/userMenus/{userMenus}', ['as'=> 'admin.userMenus.update', 'uses' => 'UserMenuController@update']);
Route::patch('admin/userMenus/{userMenus}', ['as'=> 'admin.userMenus.update', 'uses' => 'UserMenuController@update']);
Route::delete('admin/userMenus/{userMenus}', ['as'=> 'admin.userMenus.destroy', 'uses' => 'UserMenuController@destroy']);
Route::get('admin/userMenus/{userMenus}', ['as'=> 'admin.userMenus.show', 'uses' => 'UserMenuController@show']);
Route::get('admin/userMenus/{userMenus}/edit', ['as'=> 'admin.userMenus.edit', 'uses' => 'UserMenuController@edit']);


Route::get('admin/groupMenus', ['as'=> 'admin.groupMenus.index', 'uses' => 'GroupMenuController@index']);
Route::post('admin/groupMenus', ['as'=> 'admin.groupMenus.store', 'uses' => 'GroupMenuController@store']);
Route::get('admin/groupMenus/create', ['as'=> 'admin.groupMenus.create', 'uses' => 'GroupMenuController@create']);
Route::put('admin/groupMenus/{groupMenus}', ['as'=> 'admin.groupMenus.update', 'uses' => 'GroupMenuController@update']);
Route::patch('admin/groupMenus/{groupMenus}', ['as'=> 'admin.groupMenus.update', 'uses' => 'GroupMenuController@update']);
Route::delete('admin/groupMenus/{groupMenus}', ['as'=> 'admin.groupMenus.destroy', 'uses' => 'GroupMenuController@destroy']);
Route::get('admin/groupMenus/{groupMenus}', ['as'=> 'admin.groupMenus.show', 'uses' => 'GroupMenuController@show']);
Route::get('admin/groupMenus/{groupMenus}/edit', ['as'=> 'admin.groupMenus.edit', 'uses' => 'GroupMenuController@edit']);
Route::post('admin/groupMenus/export',['as'=>'admin.groupMenus.export', 'uses'=>'GroupMenuController@exportExcel']);


Route::get('admin/histories', ['as'=> 'admin.histories.index', 'uses' => 'HistoryController@index']);
Route::post('admin/histories', ['as'=> 'admin.histories.store', 'uses' => 'HistoryController@store']);
Route::get('admin/histories/create', ['as'=> 'admin.histories.create', 'uses' => 'HistoryController@create']);
Route::put('admin/histories/{histories}', ['as'=> 'admin.histories.update', 'uses' => 'HistoryController@update']);
Route::patch('admin/histories/{histories}', ['as'=> 'admin.histories.update', 'uses' => 'HistoryController@update']);
Route::delete('admin/histories/{histories}', ['as'=> 'admin.histories.destroy', 'uses' => 'HistoryController@destroy']);
Route::get('admin/histories/{histories}', ['as'=> 'admin.histories.show', 'uses' => 'HistoryController@show']);
Route::get('admin/histories/{histories}/edit', ['as'=> 'admin.histories.edit', 'uses' => 'HistoryController@edit']);


Route::get('admin/users', ['as'=> 'admin.users.index', 'uses' => 'UserController@index']);
Route::post('admin/users', ['as'=> 'admin.users.store', 'uses' => 'UserController@store']);
Route::get('admin/users/create', ['as'=> 'admin.users.create', 'uses' => 'UserController@create']);
Route::put('admin/users/{users}', ['as'=> 'admin.users.update', 'uses' => 'UserController@update']);
Route::patch('admin/users/{users}', ['as'=> 'admin.users.update', 'uses' => 'UserController@update']);
Route::delete('admin/users/{users}', ['as'=> 'admin.users.destroy', 'uses' => 'UserController@destroy']);
Route::get('admin/users/{users}', ['as'=> 'admin.users.show', 'uses' => 'UserController@show']);
Route::get('admin/users/{users}/edit', ['as'=> 'admin.users.edit', 'uses' => 'UserController@edit']);
Route::post('admin/users/export',['as'=>'admin.users.export', 'uses'=>'UserController@exportExcel']);
Route::patch('admin/users/active', ['as'=> 'admin.users.active', 'uses' => 'UserController@active']);
Route::post('admin/users/common_action', ['as'=> 'admin.users.common_action', 'uses' => 'UserController@common_action']);




Route::get('admin/categories/{groups}/duplicate', ['as'=> 'admin.categories.duplicate', 'uses' => 'CategoryController@duplicate']);
Route::post('admin/categories/export',['as'=>'admin.categories.export', 'uses'=>'CategoryController@exportExcel']);
Route::get('admin/categories/active', ['as'=> 'admin.categories.active', 'uses' => 'CategoryController@active']);
Route::post('admin/categories/common_action', ['as'=> 'admin.categories.common_action', 'uses' => 'CategoryController@common_action']);


Route::get('admin/tags', ['as'=> 'admin.tags.index', 'uses' => 'TagController@index']);
Route::post('admin/tags', ['as'=> 'admin.tags.store', 'uses' => 'TagController@store']);
Route::get('admin/tags/create', ['as'=> 'admin.tags.create', 'uses' => 'TagController@create']);
Route::put('admin/tags/{tags}', ['as'=> 'admin.tags.update', 'uses' => 'TagController@update']);
Route::patch('admin/tags/{tags}', ['as'=> 'admin.tags.update', 'uses' => 'TagController@update']);
Route::delete('admin/tags/{tags}', ['as'=> 'admin.tags.destroy', 'uses' => 'TagController@destroy']);
Route::get('admin/tags/{tags}', ['as'=> 'admin.tags.show', 'uses' => 'TagController@show']);
Route::get('admin/tags/{tags}/edit', ['as'=> 'admin.tags.edit', 'uses' => 'TagController@edit']);
Route::get('admin/tags/{tags}/duplicate', ['as'=> 'admin.tags.duplicate', 'uses' => 'TagController@duplicate']);
Route::post('admin/tags/export',['as'=>'admin.tags.export', 'uses'=>'TagController@exportExcel']);




Route::get('admin/pages', ['as'=> 'admin.pages.index', 'uses' => 'PageController@index']);
Route::post('admin/pages', ['as'=> 'admin.pages.store', 'uses' => 'PageController@store']);
Route::get('admin/pages/create', ['as'=> 'admin.pages.create', 'uses' => 'PageController@create']);
Route::put('admin/pages/{pages}', ['as'=> 'admin.pages.update', 'uses' => 'PageController@update']);
Route::patch('admin/pages/{pages}', ['as'=> 'admin.pages.update', 'uses' => 'PageController@update']);
Route::delete('admin/pages/{pages}', ['as'=> 'admin.pages.destroy', 'uses' => 'PageController@destroy']);
Route::get('admin/pages/{pages}', ['as'=> 'admin.pages.show', 'uses' => 'PageController@show']);
Route::get('admin/pages/{pages}/edit', ['as'=> 'admin.pages.edit', 'uses' => 'PageController@edit']);
Route::post('admin/pages/common_action', ['as'=> 'admin.pages.common_action', 'uses' => 'PageController@common_action']);
Route::get('admin/pages/{pages}/duplicate', ['as'=> 'admin.pages.duplicate', 'uses' => 'PageController@duplicate']);


Route::get('admin/staticMenus', ['as'=> 'admin.staticMenus.index', 'uses' => 'StaticMenuController@index']);
Route::post('admin/staticMenus', ['as'=> 'admin.staticMenus.store', 'uses' => 'StaticMenuController@store']);
Route::get('admin/staticMenus/create', ['as'=> 'admin.staticMenus.create', 'uses' => 'StaticMenuController@create']);
Route::put('admin/staticMenus/{staticMenus}', ['as'=> 'admin.staticMenus.update', 'uses' => 'StaticMenuController@update']);
Route::patch('admin/staticMenus/{staticMenus}', ['as'=> 'admin.staticMenus.update', 'uses' => 'StaticMenuController@update']);
Route::delete('admin/staticMenus/{staticMenus}', ['as'=> 'admin.staticMenus.destroy', 'uses' => 'StaticMenuController@destroy']);
Route::get('admin/staticMenus/{staticMenus}', ['as'=> 'admin.staticMenus.show', 'uses' => 'StaticMenuController@show']);
Route::get('admin/staticMenus/{staticMenus}/edit', ['as'=> 'admin.staticMenus.edit', 'uses' => 'StaticMenuController@edit']);
Route::post('admin/staticMenus/common_action', ['as'=> 'admin.staticMenus.common_action', 'uses' => 'StaticMenuController@common_action']);
Route::get('admin/staticMenus/{staticMenus}/duplicate', ['as'=> 'admin.staticMenus.duplicate', 'uses' => 'StaticMenuController@duplicate']);





Route::get('admin/tags', ['as'=> 'admin.tags.index', 'uses' => 'TagController@index']);
Route::post('admin/tags', ['as'=> 'admin.tags.store', 'uses' => 'TagController@store']);
Route::get('admin/tags/create', ['as'=> 'admin.tags.create', 'uses' => 'TagController@create']);
Route::put('admin/tags/{tags}', ['as'=> 'admin.tags.update', 'uses' => 'TagController@update']);
Route::patch('admin/tags/{tags}', ['as'=> 'admin.tags.update', 'uses' => 'TagController@update']);
Route::delete('admin/tags/{tags}', ['as'=> 'admin.tags.destroy', 'uses' => 'TagController@destroy']);
Route::get('admin/tags/{tags}', ['as'=> 'admin.tags.show', 'uses' => 'TagController@show']);
Route::get('admin/tags/{tags}/edit', ['as'=> 'admin.tags.edit', 'uses' => 'TagController@edit']);






Route::get('admin/devices', ['as'=> 'admin.devices.index', 'uses' => 'DeviceController@index']);
Route::post('admin/devices', ['as'=> 'admin.devices.store', 'uses' => 'DeviceController@store']);
Route::get('admin/devices/create', ['as'=> 'admin.devices.create', 'uses' => 'DeviceController@create']);
Route::put('admin/devices/{devices}', ['as'=> 'admin.devices.update', 'uses' => 'DeviceController@update']);
Route::patch('admin/devices/{devices}', ['as'=> 'admin.devices.update', 'uses' => 'DeviceController@update']);
Route::delete('admin/devices/{devices}', ['as'=> 'admin.devices.destroy', 'uses' => 'DeviceController@destroy']);
Route::get('admin/devices/{devices}', ['as'=> 'admin.devices.show', 'uses' => 'DeviceController@show']);
Route::get('admin/devices/{devices}/edit', ['as'=> 'admin.devices.edit', 'uses' => 'DeviceController@edit']);
Route::post('admin/devices/export',['as'=>'admin.devices.export', 'uses'=>'DeviceController@exportToFile']);
Route::get('admin/devices/{devices}/duplicate', ['as'=> 'admin.devices.duplicate', 'uses' => 'DeviceController@duplicate']);




Route::get('admin/sevices', ['as'=> 'admin.sevices.index', 'uses' => 'SeviceController@index']);
Route::post('admin/sevices', ['as'=> 'admin.sevices.store', 'uses' => 'SeviceController@store']);
Route::get('admin/sevices/create', ['as'=> 'admin.sevices.create', 'uses' => 'SeviceController@create']);
Route::put('admin/sevices/{sevices}', ['as'=> 'admin.sevices.update', 'uses' => 'SeviceController@update']);
Route::patch('admin/sevices/{sevices}', ['as'=> 'admin.sevices.update', 'uses' => 'SeviceController@update']);
Route::delete('admin/sevices/{sevices}', ['as'=> 'admin.sevices.destroy', 'uses' => 'SeviceController@destroy']);
Route::get('admin/sevices/{sevices}', ['as'=> 'admin.sevices.show', 'uses' => 'SeviceController@show']);
Route::get('admin/sevices/{sevices}/edit', ['as'=> 'admin.sevices.edit', 'uses' => 'SeviceController@edit']);
Route::post('admin/sevices/export',['as'=>'admin.sevices.export', 'uses'=>'SeviceController@exportToFile']);
Route::get('admin/sevices/{sevices}/duplicate', ['as'=> 'admin.sevices.duplicate', 'uses' => 'SeviceController@duplicate']);



Route::get('admin/motelCategories', ['as'=> 'admin.motelCategories.index', 'uses' => 'MotelCategoryController@index']);
Route::post('admin/motelCategories', ['as'=> 'admin.motelCategories.store', 'uses' => 'MotelCategoryController@store']);
Route::get('admin/motelCategories/create', ['as'=> 'admin.motelCategories.create', 'uses' => 'MotelCategoryController@create']);
Route::put('admin/motelCategories/{motelCategories}', ['as'=> 'admin.motelCategories.update', 'uses' => 'MotelCategoryController@update']);
Route::patch('admin/motelCategories/{motelCategories}', ['as'=> 'admin.motelCategories.update', 'uses' => 'MotelCategoryController@update']);
Route::delete('admin/motelCategories/{motelCategories}', ['as'=> 'admin.motelCategories.destroy', 'uses' => 'MotelCategoryController@destroy']);
Route::get('admin/motelCategories/{motelCategories}', ['as'=> 'admin.motelCategories.show', 'uses' => 'MotelCategoryController@show']);
Route::get('admin/motelCategories/{motelCategories}/edit', ['as'=> 'admin.motelCategories.edit', 'uses' => 'MotelCategoryController@edit']);
Route::get('admin/motelCategories/{motelCategories}/duplicate', ['as'=> 'admin.motelCategories.duplicate', 'uses' => 'MotelCategoryController@duplicate']);
Route::post('admin/motelCategories/export',['as'=>'admin.motelCategories.export', 'uses'=>'MotelCategoryController@export']);
Route::get('admin/motelCategories/active', ['as'=> 'admin.motelCategories.active', 'uses' => 'MotelCategoryController@active']);



Route::get('admin/provinces', ['as'=> 'admin.provinces.index', 'uses' => 'ProvinceController@index']);
Route::post('admin/provinces', ['as'=> 'admin.provinces.store', 'uses' => 'ProvinceController@store']);
Route::get('admin/provinces/create', ['as'=> 'admin.provinces.create', 'uses' => 'ProvinceController@create']);
Route::put('admin/provinces/{provinces}', ['as'=> 'admin.provinces.update', 'uses' => 'ProvinceController@update']);
Route::patch('admin/provinces/{provinces}', ['as'=> 'admin.provinces.update', 'uses' => 'ProvinceController@update']);
Route::delete('admin/provinces/{provinces}', ['as'=> 'admin.provinces.destroy', 'uses' => 'ProvinceController@destroy']);
Route::get('admin/provinces/{provinces}', ['as'=> 'admin.provinces.show', 'uses' => 'ProvinceController@show']);
Route::get('admin/provinces/{provinces}/edit', ['as'=> 'admin.provinces.edit', 'uses' => 'ProvinceController@edit']);
Route::get('admin/provinces/{provinces}/duplicate', ['as'=> 'admin.provinces.duplicate', 'uses' => 'ProvinceController@duplicate']);
Route::post('admin/provinces/export',['as'=>'admin.provinces.export', 'uses'=>'ProvinceController@exportExcel']);
Route::get('admin/provinces/active', ['as'=> 'admin.provinces.active', 'uses' => 'ProvinceController@active']);
Route::post('admin/provinces/common_action', ['as'=> 'admin.provinces.common_action', 'uses' => 'ProvinceController@common_action']);


Route::get('admin/districts', ['as'=> 'admin.districts.index', 'uses' => 'DistrictController@index']);
Route::post('admin/districts', ['as'=> 'admin.districts.store', 'uses' => 'DistrictController@store']);
Route::get('admin/districts/create', ['as'=> 'admin.districts.create', 'uses' => 'DistrictController@create']);
Route::put('admin/districts/{districts}', ['as'=> 'admin.districts.update', 'uses' => 'DistrictController@update']);
Route::patch('admin/districts/{districts}', ['as'=> 'admin.districts.update', 'uses' => 'DistrictController@update']);
Route::delete('admin/districts/{districts}', ['as'=> 'admin.districts.destroy', 'uses' => 'DistrictController@destroy']);
Route::get('admin/districts/{districts}', ['as'=> 'admin.districts.show', 'uses' => 'DistrictController@show']);
Route::get('admin/districts/{districts}/edit', ['as'=> 'admin.districts.edit', 'uses' => 'DistrictController@edit']);
Route::get('admin/districts/{districts}/duplicate', ['as'=> 'admin.districts.duplicate', 'uses' => 'DistrictController@duplicate']);
Route::post('admin/districts/export',['as'=>'admin.districts.export', 'uses'=>'DistrictController@exportExcel']);
Route::get('admin/districts/active', ['as'=> 'admin.districts.active', 'uses' => 'DistrictController@active']);
Route::post('admin/districts/common_action', ['as'=> 'admin.districts.common_action', 'uses' => 'DistrictController@common_action']);


Route::get('admin/towns', ['as'=> 'admin.towns.index', 'uses' => 'TownController@index']);
Route::post('admin/towns', ['as'=> 'admin.towns.store', 'uses' => 'TownController@store']);
Route::get('admin/towns/create', ['as'=> 'admin.towns.create', 'uses' => 'TownController@create']);
Route::put('admin/towns/{towns}', ['as'=> 'admin.towns.update', 'uses' => 'TownController@update']);
Route::patch('admin/towns/{towns}', ['as'=> 'admin.towns.update', 'uses' => 'TownController@update']);
Route::delete('admin/towns/{towns}', ['as'=> 'admin.towns.destroy', 'uses' => 'TownController@destroy']);
Route::get('admin/towns/{towns}', ['as'=> 'admin.towns.show', 'uses' => 'TownController@show']);
Route::get('admin/towns/{towns}/edit', ['as'=> 'admin.towns.edit', 'uses' => 'TownController@edit']);
Route::get('admin/towns/{districts}/duplicate', ['as'=> 'admin.towns.duplicate', 'uses' => 'TownController@duplicate']);
Route::post('admin/towns/export',['as'=>'admin.towns.export', 'uses'=>'TownController@exportExcel']);
Route::get('admin/towns/active', ['as'=> 'admin.towns.active', 'uses' => 'TownController@active']);
Route::post('admin/towns/common_action', ['as'=> 'admin.towns.common_action', 'uses' => 'TownController@common_action']);


Route::get('admin/streets', ['as'=> 'admin.streets.index', 'uses' => 'StreetController@index']);
Route::post('admin/streets', ['as'=> 'admin.streets.store', 'uses' => 'StreetController@store']);
Route::get('admin/streets/create', ['as'=> 'admin.streets.create', 'uses' => 'StreetController@create']);
Route::put('admin/streets/{streets}', ['as'=> 'admin.streets.update', 'uses' => 'StreetController@update']);
Route::patch('admin/streets/{streets}', ['as'=> 'admin.streets.update', 'uses' => 'StreetController@update']);
Route::delete('admin/streets/{streets}', ['as'=> 'admin.streets.destroy', 'uses' => 'StreetController@destroy']);
Route::get('admin/streets/{streets}', ['as'=> 'admin.streets.show', 'uses' => 'StreetController@show']);
Route::get('admin/streets/{streets}/edit', ['as'=> 'admin.streets.edit', 'uses' => 'StreetController@edit']);
Route::get('admin/streets/{districts}/duplicate', ['as'=> 'admin.streets.duplicate', 'uses' => 'StreetController@duplicate']);
Route::post('admin/streets/export',['as'=>'admin.streets.export', 'uses'=>'StreetController@exportExcel']);
Route::get('admin/streets/active', ['as'=> 'admin.streets.active', 'uses' => 'StreetController@active']);
Route::post('admin/streets/common_action', ['as'=> 'admin.streets.common_action', 'uses' => 'StreetController@common_action']);


Route::get('admin/configPrices', ['as'=> 'admin.configPrices.index', 'uses' => 'ConfigPriceController@index']);
Route::post('admin/configPrices', ['as'=> 'admin.configPrices.store', 'uses' => 'ConfigPriceController@store']);
Route::get('admin/configPrices/create', ['as'=> 'admin.configPrices.create', 'uses' => 'ConfigPriceController@create']);
Route::put('admin/configPrices/{configPrices}', ['as'=> 'admin.configPrices.update', 'uses' => 'ConfigPriceController@update']);
Route::patch('admin/configPrices/{configPrices}', ['as'=> 'admin.configPrices.update', 'uses' => 'ConfigPriceController@update']);
Route::delete('admin/configPrices/{configPrices}', ['as'=> 'admin.configPrices.destroy', 'uses' => 'ConfigPriceController@destroy']);
Route::get('admin/configPrices/{configPrices}', ['as'=> 'admin.configPrices.show', 'uses' => 'ConfigPriceController@show']);
Route::get('admin/configPrices/{configPrices}/edit', ['as'=> 'admin.configPrices.edit', 'uses' => 'ConfigPriceController@edit']);
Route::post('admin/configPrices/export',['as'=>'admin.configPrices.export', 'uses'=>'ConfigPriceController@exportToFile']);
Route::get('admin/configPrices/{configPrices}/duplicate', ['as'=> 'admin.configPrices.duplicate', 'uses' => 'ConfigPriceController@duplicate']);



Route::get('admin/feedbackMotelTypes', ['as'=> 'admin.feedbackMotelTypes.index', 'uses' => 'FeedbackMotelTypeController@index']);
Route::post('admin/feedbackMotelTypes', ['as'=> 'admin.feedbackMotelTypes.store', 'uses' => 'FeedbackMotelTypeController@store']);
Route::get('admin/feedbackMotelTypes/create', ['as'=> 'admin.feedbackMotelTypes.create', 'uses' => 'FeedbackMotelTypeController@create']);
Route::put('admin/feedbackMotelTypes/{feedbackMotelTypes}', ['as'=> 'admin.feedbackMotelTypes.update', 'uses' => 'FeedbackMotelTypeController@update']);
Route::patch('admin/feedbackMotelTypes/{feedbackMotelTypes}', ['as'=> 'admin.feedbackMotelTypes.update', 'uses' => 'FeedbackMotelTypeController@update']);
Route::delete('admin/feedbackMotelTypes/{feedbackMotelTypes}', ['as'=> 'admin.feedbackMotelTypes.destroy', 'uses' => 'FeedbackMotelTypeController@destroy']);
Route::get('admin/feedbackMotelTypes/{feedbackMotelTypes}', ['as'=> 'admin.feedbackMotelTypes.show', 'uses' => 'FeedbackMotelTypeController@show']);
Route::get('admin/feedbackMotelTypes/{feedbackMotelTypes}/edit', ['as'=> 'admin.feedbackMotelTypes.edit', 'uses' => 'FeedbackMotelTypeController@edit']);
Route::post('admin/feedbackMotelTypes/export',['as'=>'admin.feedbackMotelTypes.export', 'uses'=>'FeedbackMotelTypeController@export']);




Route::get('admin/profiles', ['as'=> 'admin.profiles.index', 'uses' => 'ProfileController@index']);
Route::post('admin/profiles', ['as'=> 'admin.profiles.store', 'uses' => 'ProfileController@store']);
Route::get('admin/profiles/create', ['as'=> 'admin.profiles.create', 'uses' => 'ProfileController@create']);
Route::put('admin/profiles/{profiles}', ['as'=> 'admin.profiles.update', 'uses' => 'ProfileController@update']);
Route::patch('admin/profiles/{profiles}', ['as'=> 'admin.profiles.update', 'uses' => 'ProfileController@update']);
Route::delete('admin/profiles/{profiles}', ['as'=> 'admin.profiles.destroy', 'uses' => 'ProfileController@destroy']);
Route::get('admin/profiles/{profiles}', ['as'=> 'admin.profiles.show', 'uses' => 'ProfileController@show']);
Route::get('admin/profiles/{profiles}/edit', ['as'=> 'admin.profiles.edit', 'uses' => 'ProfileController@edit']);


Route::get('admin/feedbackProfiles', ['as'=> 'admin.feedbackProfiles.index', 'uses' => 'FeedbackProfileController@index']);
Route::post('admin/feedbackProfiles', ['as'=> 'admin.feedbackProfiles.store', 'uses' => 'FeedbackProfileController@store']);
Route::get('admin/feedbackProfiles/create', ['as'=> 'admin.feedbackProfiles.create', 'uses' => 'FeedbackProfileController@create']);
Route::put('admin/feedbackProfiles/{feedbackProfiles}', ['as'=> 'admin.feedbackProfiles.update', 'uses' => 'FeedbackProfileController@update']);
Route::patch('admin/feedbackProfiles/{feedbackProfiles}', ['as'=> 'admin.feedbackProfiles.update', 'uses' => 'FeedbackProfileController@update']);
Route::delete('admin/feedbackProfiles/{feedbackProfiles}', ['as'=> 'admin.feedbackProfiles.destroy', 'uses' => 'FeedbackProfileController@destroy']);
Route::get('admin/feedbackProfiles/{feedbackProfiles}', ['as'=> 'admin.feedbackProfiles.show', 'uses' => 'FeedbackProfileController@show']);
Route::get('admin/feedbackProfiles/{feedbackProfiles}/edit', ['as'=> 'admin.feedbackProfiles.edit', 'uses' => 'FeedbackProfileController@edit']);




Route::get('admin/posts', ['as'=> 'admin.posts.index', 'uses' => 'PostController@index']);
Route::post('admin/posts', ['as'=> 'admin.posts.store', 'uses' => 'PostController@store']);
Route::get('admin/posts/create', ['as'=> 'admin.posts.create', 'uses' => 'PostController@create']);
Route::put('admin/posts/{posts}', ['as'=> 'admin.posts.update', 'uses' => 'PostController@update']);
Route::patch('admin/posts/{posts}', ['as'=> 'admin.posts.update', 'uses' => 'PostController@update']);
Route::delete('admin/posts/{posts}', ['as'=> 'admin.posts.destroy', 'uses' => 'PostController@destroy']);
Route::get('admin/posts/{posts}', ['as'=> 'admin.posts.show', 'uses' => 'PostController@show']);
Route::get('admin/posts/{posts}/edit', ['as'=> 'admin.posts.edit', 'uses' => 'PostController@edit']);
Route::get('admin/posts/{posts}/duplicate', ['as'=> 'admin.posts.duplicate', 'uses' => 'PostController@duplicate']);
Route::get('admin/posts/{posts}/active', ['as'=> 'admin.posts.active', 'uses' => 'PostController@active']);



Route::get('admin/postTags', ['as'=> 'admin.postTags.index', 'uses' => 'PostTagController@index']);
Route::post('admin/postTags', ['as'=> 'admin.postTags.store', 'uses' => 'PostTagController@store']);
Route::get('admin/postTags/create', ['as'=> 'admin.postTags.create', 'uses' => 'PostTagController@create']);
Route::put('admin/postTags/{postTags}', ['as'=> 'admin.postTags.update', 'uses' => 'PostTagController@update']);
Route::patch('admin/postTags/{postTags}', ['as'=> 'admin.postTags.update', 'uses' => 'PostTagController@update']);
Route::delete('admin/postTags/{postTags}', ['as'=> 'admin.postTags.destroy', 'uses' => 'PostTagController@destroy']);
Route::get('admin/postTags/{postTags}', ['as'=> 'admin.postTags.show', 'uses' => 'PostTagController@show']);
Route::get('admin/postTags/{postTags}/edit', ['as'=> 'admin.postTags.edit', 'uses' => 'PostTagController@edit']);


Route::get('admin/commentPosts', ['as'=> 'admin.commentPosts.index', 'uses' => 'CommentPostController@index']);
Route::post('admin/commentPosts', ['as'=> 'admin.commentPosts.store', 'uses' => 'CommentPostController@store']);
Route::get('admin/commentPosts/create', ['as'=> 'admin.commentPosts.create', 'uses' => 'CommentPostController@create']);
Route::put('admin/commentPosts/{commentPosts}', ['as'=> 'admin.commentPosts.update', 'uses' => 'CommentPostController@update']);
Route::patch('admin/commentPosts/{commentPosts}', ['as'=> 'admin.commentPosts.update', 'uses' => 'CommentPostController@update']);
Route::delete('admin/commentPosts/{commentPosts}', ['as'=> 'admin.commentPosts.destroy', 'uses' => 'CommentPostController@destroy']);
Route::get('admin/commentPosts/{commentPosts}', ['as'=> 'admin.commentPosts.show', 'uses' => 'CommentPostController@show']);
Route::get('admin/commentPosts/{commentPosts}/edit', ['as'=> 'admin.commentPosts.edit', 'uses' => 'CommentPostController@edit']);


Route::get('admin/motels', ['as'=> 'admin.motels.index', 'uses' => 'MotelController@index']);
Route::post('admin/motels', ['as'=> 'admin.motels.store', 'uses' => 'MotelController@store']);
Route::get('admin/motels/create', ['as'=> 'admin.motels.create', 'uses' => 'MotelController@create']);
Route::put('admin/motels/{motels}', ['as'=> 'admin.motels.update', 'uses' => 'MotelController@update']);
Route::patch('admin/motels/{motels}', ['as'=> 'admin.motels.update', 'uses' => 'MotelController@update']);
Route::delete('admin/motels/{motels}', ['as'=> 'admin.motels.destroy', 'uses' => 'MotelController@destroy']);
Route::get('admin/motels/{motels}', ['as'=> 'admin.motels.show', 'uses' => 'MotelController@show']);
Route::get('admin/motels/{motels}/edit', ['as'=> 'admin.motels.edit', 'uses' => 'MotelController@edit']);
//Route::get('admin/motels/{motels}/getDistrict', ['as'=> 'admin.motels.getDistrict', 'uses' => 'MotelController@getDistrict']);


Route::get('admin/configMotelCategories', ['as'=> 'admin.configMotelCategories.index', 'uses' => 'ConfigMotelCategoryController@index']);
Route::post('admin/configMotelCategories', ['as'=> 'admin.configMotelCategories.store', 'uses' => 'ConfigMotelCategoryController@store']);
Route::get('admin/configMotelCategories/create', ['as'=> 'admin.configMotelCategories.create', 'uses' => 'ConfigMotelCategoryController@create']);
Route::put('admin/configMotelCategories/{configMotelCategories}', ['as'=> 'admin.configMotelCategories.update', 'uses' => 'ConfigMotelCategoryController@update']);
Route::patch('admin/configMotelCategories/{configMotelCategories}', ['as'=> 'admin.configMotelCategories.update', 'uses' => 'ConfigMotelCategoryController@update']);
Route::delete('admin/configMotelCategories/{configMotelCategories}', ['as'=> 'admin.configMotelCategories.destroy', 'uses' => 'ConfigMotelCategoryController@destroy']);
Route::get('admin/configMotelCategories/{configMotelCategories}', ['as'=> 'admin.configMotelCategories.show', 'uses' => 'ConfigMotelCategoryController@show']);
Route::get('admin/configMotelCategories/{configMotelCategories}/edit', ['as'=> 'admin.configMotelCategories.edit', 'uses' => 'ConfigMotelCategoryController@edit']);


Route::get('admin/valueConfigMotels', ['as'=> 'admin.valueConfigMotels.index', 'uses' => 'ValueConfigMotelController@index']);
Route::post('admin/valueConfigMotels', ['as'=> 'admin.valueConfigMotels.store', 'uses' => 'ValueConfigMotelController@store']);
Route::get('admin/valueConfigMotels/create', ['as'=> 'admin.valueConfigMotels.create', 'uses' => 'ValueConfigMotelController@create']);
Route::put('admin/valueConfigMotels/{valueConfigMotels}', ['as'=> 'admin.valueConfigMotels.update', 'uses' => 'ValueConfigMotelController@update']);
Route::patch('admin/valueConfigMotels/{valueConfigMotels}', ['as'=> 'admin.valueConfigMotels.update', 'uses' => 'ValueConfigMotelController@update']);
Route::delete('admin/valueConfigMotels/{valueConfigMotels}', ['as'=> 'admin.valueConfigMotels.destroy', 'uses' => 'ValueConfigMotelController@destroy']);
Route::get('admin/valueConfigMotels/{valueConfigMotels}', ['as'=> 'admin.valueConfigMotels.show', 'uses' => 'ValueConfigMotelController@show']);
Route::get('admin/valueConfigMotels/{valueConfigMotels}/edit', ['as'=> 'admin.valueConfigMotels.edit', 'uses' => 'ValueConfigMotelController@edit']);


Route::get('admin/imageMotels', ['as'=> 'admin.imageMotels.index', 'uses' => 'ImageMotelController@index']);
Route::post('admin/imageMotels', ['as'=> 'admin.imageMotels.store', 'uses' => 'ImageMotelController@store']);
Route::get('admin/imageMotels/create', ['as'=> 'admin.imageMotels.create', 'uses' => 'ImageMotelController@create']);
Route::put('admin/imageMotels/{imageMotels}', ['as'=> 'admin.imageMotels.update', 'uses' => 'ImageMotelController@update']);
Route::patch('admin/imageMotels/{imageMotels}', ['as'=> 'admin.imageMotels.update', 'uses' => 'ImageMotelController@update']);
Route::delete('admin/imageMotels/{imageMotels}', ['as'=> 'admin.imageMotels.destroy', 'uses' => 'ImageMotelController@destroy']);
Route::get('admin/imageMotels/{imageMotels}', ['as'=> 'admin.imageMotels.show', 'uses' => 'ImageMotelController@show']);
Route::get('admin/imageMotels/{imageMotels}/edit', ['as'=> 'admin.imageMotels.edit', 'uses' => 'ImageMotelController@edit']);


Route::get('admin/deviceMotels', ['as'=> 'admin.deviceMotels.index', 'uses' => 'DeviceMotelController@index']);
Route::post('admin/deviceMotels', ['as'=> 'admin.deviceMotels.store', 'uses' => 'DeviceMotelController@store']);
Route::get('admin/deviceMotels/create', ['as'=> 'admin.deviceMotels.create', 'uses' => 'DeviceMotelController@create']);
Route::put('admin/deviceMotels/{deviceMotels}', ['as'=> 'admin.deviceMotels.update', 'uses' => 'DeviceMotelController@update']);
Route::patch('admin/deviceMotels/{deviceMotels}', ['as'=> 'admin.deviceMotels.update', 'uses' => 'DeviceMotelController@update']);
Route::delete('admin/deviceMotels/{deviceMotels}', ['as'=> 'admin.deviceMotels.destroy', 'uses' => 'DeviceMotelController@destroy']);
Route::get('admin/deviceMotels/{deviceMotels}', ['as'=> 'admin.deviceMotels.show', 'uses' => 'DeviceMotelController@show']);
Route::get('admin/deviceMotels/{deviceMotels}/edit', ['as'=> 'admin.deviceMotels.edit', 'uses' => 'DeviceMotelController@edit']);


Route::get('admin/seviceMotels', ['as'=> 'admin.seviceMotels.index', 'uses' => 'SeviceMotelController@index']);
Route::post('admin/seviceMotels', ['as'=> 'admin.seviceMotels.store', 'uses' => 'SeviceMotelController@store']);
Route::get('admin/seviceMotels/create', ['as'=> 'admin.seviceMotels.create', 'uses' => 'SeviceMotelController@create']);
Route::put('admin/seviceMotels/{seviceMotels}', ['as'=> 'admin.seviceMotels.update', 'uses' => 'SeviceMotelController@update']);
Route::patch('admin/seviceMotels/{seviceMotels}', ['as'=> 'admin.seviceMotels.update', 'uses' => 'SeviceMotelController@update']);
Route::delete('admin/seviceMotels/{seviceMotels}', ['as'=> 'admin.seviceMotels.destroy', 'uses' => 'SeviceMotelController@destroy']);
Route::get('admin/seviceMotels/{seviceMotels}', ['as'=> 'admin.seviceMotels.show', 'uses' => 'SeviceMotelController@show']);
Route::get('admin/seviceMotels/{seviceMotels}/edit', ['as'=> 'admin.seviceMotels.edit', 'uses' => 'SeviceMotelController@edit']);


Route::get('admin/motelSaves', ['as'=> 'admin.motelSaves.index', 'uses' => 'MotelSaveController@index']);
Route::post('admin/motelSaves', ['as'=> 'admin.motelSaves.store', 'uses' => 'MotelSaveController@store']);
Route::get('admin/motelSaves/create', ['as'=> 'admin.motelSaves.create', 'uses' => 'MotelSaveController@create']);
Route::put('admin/motelSaves/{motelSaves}', ['as'=> 'admin.motelSaves.update', 'uses' => 'MotelSaveController@update']);
Route::patch('admin/motelSaves/{motelSaves}', ['as'=> 'admin.motelSaves.update', 'uses' => 'MotelSaveController@update']);
Route::delete('admin/motelSaves/{motelSaves}', ['as'=> 'admin.motelSaves.destroy', 'uses' => 'MotelSaveController@destroy']);
Route::get('admin/motelSaves/{motelSaves}', ['as'=> 'admin.motelSaves.show', 'uses' => 'MotelSaveController@show']);
Route::get('admin/motelSaves/{motelSaves}/edit', ['as'=> 'admin.motelSaves.edit', 'uses' => 'MotelSaveController@edit']);


Route::get('admin/rooms', ['as'=> 'admin.rooms.index', 'uses' => 'RoomController@index']);
Route::post('admin/rooms', ['as'=> 'admin.rooms.store', 'uses' => 'RoomController@store']);
Route::get('admin/rooms/create', ['as'=> 'admin.rooms.create', 'uses' => 'RoomController@create']);
Route::put('admin/rooms/{rooms}', ['as'=> 'admin.rooms.update', 'uses' => 'RoomController@update']);
Route::patch('admin/rooms/{rooms}', ['as'=> 'admin.rooms.update', 'uses' => 'RoomController@update']);
Route::delete('admin/rooms/{rooms}', ['as'=> 'admin.rooms.destroy', 'uses' => 'RoomController@destroy']);
Route::get('admin/rooms/{rooms}', ['as'=> 'admin.rooms.show', 'uses' => 'RoomController@show']);
Route::get('admin/rooms/{rooms}/edit', ['as'=> 'admin.rooms.edit', 'uses' => 'RoomController@edit']);


Route::get('admin/feedbackMotels', ['as'=> 'admin.feedbackMotels.index', 'uses' => 'FeedbackMotelController@index']);
Route::post('admin/feedbackMotels', ['as'=> 'admin.feedbackMotels.store', 'uses' => 'FeedbackMotelController@store']);
Route::get('admin/feedbackMotels/create', ['as'=> 'admin.feedbackMotels.create', 'uses' => 'FeedbackMotelController@create']);
Route::put('admin/feedbackMotels/{feedbackMotels}', ['as'=> 'admin.feedbackMotels.update', 'uses' => 'FeedbackMotelController@update']);
Route::patch('admin/feedbackMotels/{feedbackMotels}', ['as'=> 'admin.feedbackMotels.update', 'uses' => 'FeedbackMotelController@update']);
Route::delete('admin/feedbackMotels/{feedbackMotels}', ['as'=> 'admin.feedbackMotels.destroy', 'uses' => 'FeedbackMotelController@destroy']);
Route::get('admin/feedbackMotels/{feedbackMotels}', ['as'=> 'admin.feedbackMotels.show', 'uses' => 'FeedbackMotelController@show']);
Route::get('admin/feedbackMotels/{feedbackMotels}/edit', ['as'=> 'admin.feedbackMotels.edit', 'uses' => 'FeedbackMotelController@edit']);


Route::get('admin/postCategories', ['as'=> 'admin.postCategories.index', 'uses' => 'PostCategoryController@index']);
Route::post('admin/postCategories', ['as'=> 'admin.postCategories.store', 'uses' => 'PostCategoryController@store']);
Route::get('admin/postCategories/create', ['as'=> 'admin.postCategories.create', 'uses' => 'PostCategoryController@create']);
Route::put('admin/postCategories/{postCategories}', ['as'=> 'admin.postCategories.update', 'uses' => 'PostCategoryController@update']);
Route::patch('admin/postCategories/{postCategories}', ['as'=> 'admin.postCategories.update', 'uses' => 'PostCategoryController@update']);
Route::delete('admin/postCategories/{postCategories}', ['as'=> 'admin.postCategories.destroy', 'uses' => 'PostCategoryController@destroy']);
Route::get('admin/postCategories/{postCategories}', ['as'=> 'admin.postCategories.show', 'uses' => 'PostCategoryController@show']);
Route::get('admin/postCategories/{postCategories}/edit', ['as'=> 'admin.postCategories.edit', 'uses' => 'PostCategoryController@edit']);
Route::get('admin/postCategories/{postCategories}/duplicate', ['as'=> 'admin.postCategories.duplicate', 'uses' => 'PostCategoryController@duplicate']);
Route::post('admin/postCategories/export',['as'=>'admin.postCategories.export', 'uses'=>'PostCategoryController@export']);
Route::get('admin/postCategories/active', ['as'=> 'admin.postCategories.active', 'uses' => 'PostCategoryController@active']);




Route::get('admin/categoryPosts', ['as'=> 'admin.categoryPosts.index', 'uses' => 'CategoryPostController@index']);
Route::post('admin/categoryPosts', ['as'=> 'admin.categoryPosts.store', 'uses' => 'CategoryPostController@store']);
Route::get('admin/categoryPosts/create', ['as'=> 'admin.categoryPosts.create', 'uses' => 'CategoryPostController@create']);
Route::put('admin/categoryPosts/{categoryPosts}', ['as'=> 'admin.categoryPosts.update', 'uses' => 'CategoryPostController@update']);
Route::patch('admin/categoryPosts/{categoryPosts}', ['as'=> 'admin.categoryPosts.update', 'uses' => 'CategoryPostController@update']);
Route::delete('admin/categoryPosts/{categoryPosts}', ['as'=> 'admin.categoryPosts.destroy', 'uses' => 'CategoryPostController@destroy']);
Route::get('admin/categoryPosts/{categoryPosts}', ['as'=> 'admin.categoryPosts.show', 'uses' => 'CategoryPostController@show']);
Route::get('admin/categoryPosts/{categoryPosts}/edit', ['as'=> 'admin.categoryPosts.edit', 'uses' => 'CategoryPostController@edit']);
