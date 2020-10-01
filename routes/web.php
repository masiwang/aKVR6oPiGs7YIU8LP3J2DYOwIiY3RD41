<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
Route::get('/', 'HomeController@index'); // menampilkan halaman utama guest

Route::get('/perusahaan', 'IndustryController@index_guest'); // menampilkan halaman daftar perusahaan untuk guest
Route::get('/artikel', 'ArticleController@index_guest');
Route::get('/artikel/{id}', 'ArticleController@detail_guest');
// Login
Route::get( 'login', 'AuthController@login')->name('login'); // menampilkan halaman login
Route::post('login', 'AuthController@login_do'); // mengeksekusi login
Route::get('logout', 'AuthController@logout'); // mengeksekusi logout

Route::get('verifikasi/{token}', 'EmailController@verification_do'); // melakukan verifikasi email berdasarkan token yang telah dikirim

Route::middleware('auth')->group(function () {
    //index admin
    Route::get('admin', 'DashboardController@index'); // menampilkan halaman dashboard admin

    Route::get( 'admin/list',   'AdminController@index'); // menampilkan daftar admin
    Route::get( 'admin/new',    'AdminController@new'); // menampilkan halaman form pernambahan admin baru
    Route::post('admin/new',    'AdminController@new_save'); // meneksekusi form penambahan admin baru

    Route::get( 'admin/profile',                    'AuthController@profile'); //menampilkan halaman profil admin yang sedang login
    Route::post('admin/profile/update',             'AuthController@update'); // mengeksekusi perubahan (update) data admin yang sedang login
    Route::post('admin/profile/update/image',       'AuthController@update_image'); // mengeksekusi perubahan foto profile admin yang sedang login
    Route::get( 'admin/profile/email_verification', 'EmailController@email_verification'); // menampilkan halaman verifikasi email
    
    // ===== ARTICLE =====
    Route::get('admin/article',                 'ArticleController@index'); // menampilkan list artikel
    Route::get('admin/article/new',             'ArticleController@new'); // form artikel baru
    Route::post('admin/article/new',            'ArticleController@new_save'); // menyimpan artikel baru
    Route::get('admin/article/{id}',            'ArticleController@detail'); // menampilkan artikel berdasarkan id
    Route::get('admin/article/{id}/edit',       'ArticleController@edit'); // menampilkan form edit artikel berdasarkan id
    Route::post('admin/article/{id}/edit',      'ArticleController@edit_save'); // menyimpan hasil edit artikel berdasarkan id
    Route::post('admin/article/{id}/edit/image','ArticleController@edit_image'); // menyimpan hasil edit gambar artikel berdasarkan id
    Route::post('admin/article/{id}/delete',    'ArticleController@delete'); // menghapus artikel berdasarkan id

    // ===== LOGS =====
    Route::get('admin/logs', 'AdminController@log');//FIX 

    // ===== PERUSAHAAN =====
    Route::get( 'admin/perusahaan',                 'IndustryController@index'); // menampilkan list perusahaan
    Route::get( 'admin/perusahaan/{id}/detail',     'IndustryController@detail'); // menampilkan detail perusahaan berdasarkan id
    Route::get( 'admin/perusahaan/new',             'IndustryController@new'); // menampilkan form perusahaan baru
    Route::post('admin/perusahaan/new',             'IndustryController@new_save'); // menyimpan perusahaan baru
    Route::get( 'admin/perusahaan/{id}/edit',       'IndustryController@edit'); // menampilkan halaman form perubahna data perusahaan
    Route::post('admin/perusahaan/{id}/edit',       'IndustryController@edit_save'); // menyimpan form perubahan data perusahaan
    Route::post('admin/perusahaan/{id}/edit/image', 'IndustryEditController@edit_image'); // menyimpan perubahan foto perusahaan
    Route::post('admin/perusahaan/{id}/delete',     'IndustryController@delete'); // mengeksekusi penghapusan data perusahaan
    Route::get( 'admin/perusahaan/import',          'IndustryImportController@import'); // menampilkan halaman import data perusahaan
    Route::get(' admin/perusahaan/import/template', 'IndustryImportController@download_template'); // mengeksekusi perintah download template
    Route::post('admin/perusahaan/import/images',   'IndustryImportController@images_save'); // mengeksekusi perintah import foto-foto perusahaan
    Route::post('admin/perusahaan/import/speadsheet','IndustryImportController@spreadsheet_save'); // mengeksekusi perintah import spreadsheet data perusahaan
    Route::get( 'admin/perusahaan/download',        'IndustryExportController@export'); // mengeksekusi perintah eksport data perusahaan

    // ===== Email =====
    Route::get('admin/send_email_token', 'EmailController@verification_email_send'); // eksekusi perintah pengiriman token verifikasi email

    // ===== API =====
    Route::post('admin/get_nama_industri', function (Request $request) {
        $kblis = DB::table('sii_kbli')->where('tipe_industri_id', $request->tipe)->get();
        return response()->json($kblis, 200);
    });
});