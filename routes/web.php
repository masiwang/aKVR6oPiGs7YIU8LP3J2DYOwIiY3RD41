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

Route::get('/', 'HomeController@index'); // FIX
Route::get('/perusahaan', 'HomeController@getPerusahaan');
Route::get('/mobile', 'HomeController@index_mobile');

// Login
Route::get( 'login', 'AuthController@login')->name('login'); // FIX
Route::post('login', 'AuthController@login_do'); // FIX

Route::get('logout', 'AuthController@logout'); // FIX

Route::get('/map', 'IndustriController@get_location');

Route::middleware('auth')->group(function () {
    //index admin
    Route::get('admin', 'DashboardController@index'); // FIX

    Route::get('admin/list', 'AdminController@index'); // FIX
    Route::get('admin/new', 'AdminNewController@new'); // FIX
    Route::post('admin/new', 'AdminNewController@new_save'); // FIX

    Route::get('admin/profile', 'AdminProfileController@index');//FIX
    Route::post('admin/profile/update', 'AdminProfileController@update');//FIX
    Route::post('admin/profile/update/image', 'AdminProfileController@update_image');//FIX
    
    // ===== ARTICLE =====
    Route::get('admin/article', 'ArticleController@index'); //FIX
    Route::get('admin/article/new', 'ArticleNewController@new'); //FIX
    Route::post('admin/article/new', 'ArticleNewController@new_save'); //FIX
    Route::get('admin/article/{id}', 'ArticleDetailController@detail'); // FIX
    Route::get('admin/article/{id}/edit', 'ArticleEditController@edit'); //FIX
    Route::post('admin/article/{id}/edit', 'ArticleEditController@edit_save'); //FIX
    Route::post('admin/article/{id}/edit/image', 'ArticleEditController@edit_image'); //FIX
    Route::post('admin/article/{id}/delete', 'ArticleDeleteController@delete'); //FIX

    // ===== LOGS =====
    Route::get('admin/logs', 'AdminLogController@index');//FIX

    // ===== PERUSAHAAN =====
    Route::get( 'admin/perusahaan', 'IndustryController@index'); // FIX
    Route::get( 'admin/perusahaan/{id}/detail', 'IndustryDetailController@detail'); // FIX
    Route::get( 'admin/perusahaan/new', 'IndustryNewController@new'); // FIX
    Route::post('admin/perusahaan/new', 'IndustryNewController@new_save'); // FIX
    Route::get( 'admin/perusahaan/{id}/edit', 'IndustryEditController@edit'); //FIX
    Route::post('admin/perusahaan/{id}/edit', 'IndustryEditController@edit_save'); //FIX
    Route::post('admin/perusahaan/{id}/edit/image', 'IndustryEditController@edit_image'); //FIX
    Route::post('admin/perusahaan/{id}/delete', 'IndustryDeleteController@delete');//FIX
    Route::get( 'admin/perusahaan/import', 'IndustryImportController@import'); //FIX
    Route::get(' admin/perusahaan/import/template', 'IndustryImportController@download_template'); // FIX
    Route::post('admin/perusahaan/import/images', 'IndustryImportController@images_save'); // FIX
    Route::post('admin/perusahaan/import/speadsheet',  'PerusahaanController@import_speadsheet_save'); //TODO
    Route::get( 'admin/perusahaan/download', 'IndustryExportController@export'); // FIX
});