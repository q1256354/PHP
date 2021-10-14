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
Route::get('/db_info', 'MariaDBController@index');
Route::get('/erp_user', 'MariaDBController@user')->middleware('auth');
Route::get('/status', 'AjaxController@status')->middleware('auth');
Route::get('/edit_member', 'MemberinfoController@edit_member')->middleware('auth');
Route::post('/update_member', 'MemberinfoController@update_member')->middleware('auth');
/*
|--------------------------------------------------------------------------
| Custom路由
|--------------------------------------------------------------------------
*/
Route::get('/erp_customer', 'CustomerController@customer')->middleware('auth');
Route::post('/add_customer', 'CustomerController@add_customer')->middleware('auth');
Route::get('/edit_customer', 'CustomerController@edit_customer')->middleware('auth');
Route::post('/update_customer', 'CustomerController@update_customer')->middleware('auth');
Route::post('/import_customer', 'CustomerController@import_customer')->middleware('auth');
Route::post('/import_customer_excel', 'CustomerController@import_customer_excel')->middleware('auth');
Route::get('/export_customer', 'CustomerController@export_customer')->middleware('auth');
Route::get('/export_customer_excel', 'CustomerController@export_customer_excel')->middleware('auth');
Route::get('/erp_customer_add', function () {
    return view('erp_customer_add');
    })->middleware('auth');
/*
|--------------------------------------------------------------------------
| Device路由
|--------------------------------------------------------------------------
*/
Route::get('/erp_device', 'DeviceController@device')->middleware('auth');
Route::post('/add_device', 'DeviceController@add_device')->middleware('auth');
Route::post('/update_device', 'DeviceController@update_device')->middleware('auth');
Route::get('/edit_device', 'DeviceController@edit_device')->middleware('auth');
Route::post('/import_device', 'DeviceController@import_device')->middleware('auth');
Route::post('/import_device_excel', 'DeviceController@import_device_excel')->middleware('auth');
Route::get('/export_device', 'DeviceController@export_device')->middleware('auth');
Route::get('/export_device_excel', 'DeviceController@export_device_excel')->middleware('auth');
Route::get('/erp_device_add', function () {
    return view('erp_device_add');
    })->middleware('auth');
/*
|--------------------------------------------------------------------------
| Repair路由
|--------------------------------------------------------------------------
*/
Route::get('/erp_repair', 'RepairController@repair')->middleware('auth');
Route::post('/add_repair', 'RepairController@add_repair')->middleware('auth');
Route::get('/export_repair', 'RepairController@export_repair')->middleware('auth');
Route::get('/mail_test', 'RepairController@mail_test')->middleware('auth');
Route::get('/download_test', 'RepairController@download_test')->middleware('auth');
Route::get('/export_repair_excel', 'RepairController@export_repair_excel')->middleware('auth');
Route::get('/erp_repair_add', function () {
    return view('erp_repair_add');
    })->middleware('auth');
/*
|--------------------------------------------------------------------------
| Leave路由
|--------------------------------------------------------------------------
*/
Route::get('/erp_leave', 'LeaveController@leave')->middleware('auth');
Route::post('/add_leave', 'LeaveController@add_leave')->middleware('auth');
Route::post('/review_leave', 'LeaveController@review_leave')->middleware('auth');
Route::post('/update_leave', 'LeaveController@update_leave')->middleware('auth');
Route::get('/edit_leave', 'LeaveController@edit_leave')->middleware('auth');
Route::get('/export_leave', 'LeaveController@export_leave')->middleware('auth');
Route::get('/erp_leave_add', function () {
    return view('erp_leave_add');
    })->middleware('auth');
/*
|--------------------------------------------------------------------------
| Shipment路由
|--------------------------------------------------------------------------
*/
Route::get('/erp_shipment', 'ShipmentController@shipment')->middleware('auth');
Route::post('/add_shipment', 'ShipmentController@add_shipment')->middleware('auth');
Route::post('/update_shipment', 'ShipmentController@update_shipment')->middleware('auth');
Route::get('/edit_shipment', 'ShipmentController@edit_shipment')->middleware('auth');
Route::get('/print_shipment', 'ShipmentController@print_shipment')->middleware('auth');
Route::post('/import_shipment', 'ShipmentController@import_shipment')->middleware('auth');
Route::get('/export_shipment', 'ShipmentController@export_shipment')->middleware('auth');
Route::get('/erp_shipment_add', function () {
    return view('erp_shipment_add');
    })->middleware('auth');
/*
|--------------------------------------------------------------------------
| 其他路由
|--------------------------------------------------------------------------
*/
Route::get('/memberinfo', 'MemberinfoController@member_info')->middleware('auth');
Route::get('main', function () {
    return view('main');
    })->middleware('auth');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', 'Auth\LogoutController@logout');


/*
|--------------------------------------------------------------------------
| 設置多語系使用
|--------------------------------------------------------------------------
*/
Route::get('/{locale}', function ($locale) {
    App::setLocale($locale);
	return view('welcome');
});
Route::get('/main/{locale}', function ($locale) {
    App::setLocale($locale);
	return view('main');
});
Route::get('/login/{locale}', function ($locale) {
    App::setLocale($locale);
	return view('auth/login');
});
Route::get('/register/{locale}', function ($locale) {
    App::setLocale($locale);
	return view('auth/register');
});