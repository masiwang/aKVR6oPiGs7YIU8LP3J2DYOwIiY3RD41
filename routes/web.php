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

Route::get('/', 'HomeController@index');
Route::get('/perusahaan', 'HomeController@getPerusahaan');
Route::get('/mobile', 'HomeController@index_mobile');

// Auth
Route::get('login', function(){
    if(Session::get('role')){return redirect('admin');}
    return view('auth.login');
});
Route::post('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout');

Route::get('/map', 'IndustriController@get_location');

Route::middleware('auth')->group(function () {
    //index admin
    Route::get('admin', 'AdminController@index_desktop');
    Route::get('admin/new', 'AdminController@admin_new_view');
    Route::post('admin/new/save', 'AdminController@admin_new_save');
    Route::get('admin/list', 'AdminController@admin_list');
    Route::get('admin/profile', 'AdminController@profile');
    Route::post('admin/profile/update', 'AdminController@profile_update');
    
    // ===== ARTICLE ===== TODO: Edit nih artikel bos
    Route::get('admin/article', 'ArticleController@index_desktop');
    Route::get('admin/article/create', 'ArticleController@new_desktop');
    Route::post('admin/article/create', 'ArticleController@store');
    Route::get('admin/article/{id}', 'ArticleController@show');
    Route::get('admin/article/{id}/edit', 'ArticleController@update_view');
    Route::post('admin/article/{id}/edit', 'ArticleController@update');
    Route::post('admin/article/{id}/edit/image', 'ArticleController@update_image');
    Route::get('admin/article/{id}/delete', 'ArticleController@delete_view');
    Route::post('admin/article/{id}/delete', 'ArticleController@delete');

    // ===== LOGS =====
    Route::get('admin/logs', 'LogController@index');

    // ===== PERUSAHAAN =====
    Route::get( 'admin/perusahaan',                         'PerusahaanController@index_desktop');
    Route::get( 'admin/perusahaan/{id}/view',               'PerusahaanController@view'); 
    Route::get( 'admin/perusahaan/create',                  'PerusahaanController@create_view');
    Route::post('admin/perusahaan/create_save',             'PerusahaanController@create_save');
    Route::get( 'admin/perusahaan/{id}/edit',               'PerusahaanController@edit_view');
    Route::post('admin/perusahaan/{id}/edit_save',          'PerusahaanController@edit_save');
    Route::post('admin/perusahaan/{id}/edit_image',         'PerusahaanController@edit_image');
    Route::get(' admin/perusahaan/{id}/delete',              'PerusahaanController@delete_view');
    Route::post('admin/perusahaan/{id}/delete',              'PerusahaanController@delete');
    Route::get( 'admin/perusahaan/import',                  'PerusahaanController@import');
    Route::post('admin/perusahaan/import/foto_save',        'PerusahaanController@import_foto_save');
    Route::post('admin/perusahaan/import/speadsheet_save',  'PerusahaanController@import_speadsheet_save');
    Route::post('admin/perusahaan/delete',                  'PerusahaanController@delete');
    Route::get( 'admin/perusahaan/export',                  'PerusahaanController@export');
    Route::get( 'admin/perusahaan/export/xlsx',             'PerusahaanController@export_xlsx');

    Route::get(' admin/download/template',                  'PerusahaanController@download_template');

    Route::get('admin/get', 'PerusahaanController@export_xlsx');
});

Route::get('deleteview', 'DeleteController@index');

// INDUSTRI
Route::get('converter', function(){
    return view('converter');
});