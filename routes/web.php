<?php

use Illuminate\Support\Facades\Route;

use App\Controller\DataFormPageController;
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

Route::get('/landing', function () {
    return view('landingpage.layout');
});

Route::get('/', 'App\Http\Controllers\LandingPageController@index');
Route::get('/home', 'App\Http\Controllers\LandingPageController@index');

//Controller BeritaPageController
Route::get('/detail', 'App\Http\Controllers\BeritaPageController@index');


//Controller DataFormPageController
Route::get('/dataform/timinti/{namaprovinsi}', 'App\Http\Controllers\DataFormPageController@index');
Route::get('/tambahpendukung', 'App\Http\Controllers\DataFormPageController@tambahpendukung');
Route::get('/tambahpendukungpilgub', 'App\Http\Controllers\DataFormPageController@showFormpilgubpendukung');
Route::post('/dataform/pengguna-register', 'App\Http\Controllers\DataFormPageController@penggunastore');
Route::post('/dataform/pemilih-register', 'App\Http\Controllers\DataFormPageController@pemilihstore');
Route::get('/dataform/sukses', 'App\Http\Controllers\DataFormPageController@sukses');
Route::get('/dataform/pilkab', 'App\Http\Controllers\DataFormPageController@showDataKab');
Route::get('/dataform/kab/{namakab}', 'App\Http\Controllers\DataFormPageController@showFormpilkab');
Route::get('/dataform/prov/{prov}', 'App\Http\Controllers\DataFormPageController@showFormpilgub');

//Controller dtdPagePageController ini untuk mengisi Survey Data Pemilih ( DTD )
Route::get('/dtd', 'App\Http\Controllers\DtdPageController@index');
Route::post('/dtd', 'App\Http\Controllers\DtdPageController@pemilihstore');
Route::get('/dtd/sukses', 'App\Http\Controllers\DtdPageController@sukses');


// ini gunanya untuk batasi login ->middleware('auth');
Route::get('/login', 'App\Http\Controllers\DataFormPageController@loginuser');
Route::post('/actionlogin', 'App\Http\Controllers\DataFormPageController@actionlogin')->name('actionlogin');
Route::post('/aksilogin', 'App\Http\Controllers\DataFormPageController@aksilogin')->name('aksilogin');

//Authentikasi Login User Tim Inti dan Pendukung
Route::get('pengguna/login', 'App\Http\Controllers\MasukPageController@index');
Route::post('pengguna/login', 'App\Http\Controllers\MasukPageController@authentic');
Route::get('pengguna/logout', 'App\Http\Controllers\MasukPageController@logout');

//Controller LoginPageController
Route::get('/loginoperator', 'App\Http\Controllers\LoginPageController@index');
Route::post('/loginoperator', 'App\Http\Controllers\LoginPageController@authenticate');
Route::get('/admin/logout', 'App\Http\Controllers\LoginPageController@actionlogout');
//Route::get('/landingpage', [LandingPageController::class, 'index']);

//Login User Pilkad / Pilkab
Route::get('/login-admins', 'App\Http\Controllers\LoginPageController@admins');
Route::post('/login-admins', 'App\Http\Controllers\LoginPageController@adminauthenticate');
Route::get('/admins-logout', 'App\Http\Controllers\LoginPageController@adminsactionlogout');


//Controller DashboaedPageController
Route::get('/dashboard', 'App\Http\Controllers\DashboardPageController@index');

//CRUD ACARA Admin

Route::get('/admin/user', 'App\Http\Controllers\AcaraPageController@index');
Route::get('/admin/user/tambah', 'App\Http\Controllers\AcaraPageController@tambah');
Route::post('/admin/user/tambah', 'App\Http\Controllers\AcaraPageController@simpan');
Route::get('/admin/user/ubah/{id}', 'App\Http\Controllers\AcaraPageController@ubah');
Route::post('/admin/user/update', 'App\Http\Controllers\AcaraPageController@update');
Route::get('/admin/user/hapus/{id}', 'App\Http\Controllers\AcaraPageController@hapus');

// HALAMAN ADMIN

Route::get('/admin/timinti', 'App\Http\Controllers\MasterPageController@timinti');
Route::get('/admin/pendukung', 'App\Http\Controllers\MasterPageController@pendukung');
Route::get('/admin/timintipilgub', 'App\Http\Controllers\MasterPageController@timintipilgub');
Route::get('/admin/pendukungpilgub', 'App\Http\Controllers\MasterPageController@pendukungpilgub');
Route::get('/admin/pemilih/pilkab', 'App\Http\Controllers\MasterPageController@pemilihpilkab');
Route::get('/admin/pemilih/pilgub', 'App\Http\Controllers\MasterPageController@pemilihpilgub');
Route::get('/admin/caleg', 'App\Http\Controllers\MasterPageController@caleg');

//combobox realtime bertingkat
Route::post('/admin/searchkabupaten', 'App\Http\Controllers\MasterPageController@searchkabupaten');
Route::post('/admin/searchkecamatan', 'App\Http\Controllers\MasterPageController@searchkecamatan');
Route::post('/admin/searchdesa', 'App\Http\Controllers\MasterPageController@searchdesa');
Route::post('/admin/searchpemilih', 'App\Http\Controllers\MasterPageController@searchpemilih');
Route::post('/admin/searchpemilihbobot', 'App\Http\Controllers\MasterPageController@searchpemilihbobot');
Route::post('/admin/searchpemilihgub', 'App\Http\Controllers\MasterPageController@searchpemilihgub');
Route::post('/admin/searchpemilihgubbobot', 'App\Http\Controllers\MasterPageController@searchpemilihgubbobot');

// combobox realtime Bobot
Route::post('/admin/searchkabupatenbobot', 'App\Http\Controllers\MasterPageController@searchkabupaten');
Route::post('/admin/searchkecamatanbobot', 'App\Http\Controllers\MasterPageController@searchkecamatan');
Route::post('/admin/searchdesabobot', 'App\Http\Controllers\MasterPageController@searchdesa');


Route::get('/admin/berita', 'App\Http\Controllers\BeritaPageController@home');
Route::get('/admin/berita/tambah', 'App\Http\Controllers\BeritaPageController@tambah');
Route::post('/admin/berita/tambah', 'App\Http\Controllers\BeritaPageController@simpan');
Route::get('/admin/berita/ubah/{id}', 'App\Http\Controllers\BeritaPageController@ubah');
Route::post('/admin/berita/update', 'App\Http\Controllers\BeritaPageController@update');
Route::get('/admin/berita/hapus/{id}', 'App\Http\Controllers\BeritaPageController@hapus');

//Kandidat
Route::get('/admin/kandidat', 'App\Http\Controllers\KandidatPageController@index');
Route::get('/admin/kandidat/tambah', 'App\Http\Controllers\KandidatPageController@tambah');
Route::post('/admin/kandidat/tambah', 'App\Http\Controllers\KandidatPageController@simpan');
Route::get('/admin/kandidat/ubah/{id}', 'App\Http\Controllers\KandidatPageController@ubah');
Route::post('/admin/kandidat/update', 'App\Http\Controllers\KandidatPageController@update');
Route::get('/admin/kandidat/hapus/{id}', 'App\Http\Controllers\KandidatPageController@hapus');


//dapil
Route::get('/admin/dapil', 'App\Http\Controllers\DapilPageController@index');
Route::get('/admin/dapil/tambah', 'App\Http\Controllers\DapilPageController@tambah');
Route::post('/admin/dapil/tambah', 'App\Http\Controllers\DapilPageController@simpan');
Route::get('/admin/dapil/ubah/{id}', 'App\Http\Controllers\DapilPageController@ubah');
Route::post('/admin/dapil/update', 'App\Http\Controllers\DapilPageController@update');
Route::get('/admin/dapil/hapus/{id}', 'App\Http\Controllers\DapilPageController@hapus');


//Provinsi
Route::get('/admin/provinsi', 'App\Http\Controllers\ProvinsiPageController@home');
Route::get('/admin/provinsi/tambah', 'App\Http\Controllers\ProvinsiPageController@tambah');
Route::post('/admin/provinsi/tambah', 'App\Http\Controllers\ProvinsiPageController@simpan');
Route::get('/admin/provinsi/ubah/{id}', 'App\Http\Controllers\ProvinsiPageController@ubah');
Route::post('/admin/provinsi/update', 'App\Http\Controllers\ProvinsiPageController@update');
Route::get('/admin/provinsi/hapus/{id}', 'App\Http\Controllers\ProvinsiPageController@hapus');

//Kabupaten
Route::get('/admin/kabupaten', 'App\Http\Controllers\KabupatenPageController@home');
Route::get('/admin/kabupaten/tambah', 'App\Http\Controllers\KabupatenPageController@tambah');
Route::post('/admin/kabupaten/tambah', 'App\Http\Controllers\KabupatenPageController@simpan');
Route::get('/admin/kabupaten/ubah/{id}', 'App\Http\Controllers\KabupatenPageController@ubah');
Route::post('/admin/kabupaten/update', 'App\Http\Controllers\KabupatenPageController@update');
Route::get('/admin/kabupaten/hapus/{id}', 'App\Http\Controllers\KabupatenPageController@hapus');

//Kecamatan
Route::get('/admin/kecamatan', 'App\Http\Controllers\KecamatanPageController@home');
Route::get('/admin/kecamatan/tambah', 'App\Http\Controllers\KecamatanPageController@tambah');
Route::post('/admin/kecamatan/tambah', 'App\Http\Controllers\KecamatanPageController@simpan');
Route::get('/admin/kecamatan/ubah/{id}', 'App\Http\Controllers\KecamatanPageController@ubah');
Route::post('/admin/kecamatan/update', 'App\Http\Controllers\KecamatanPageController@update');
Route::get('/admin/kecamatan/hapus/{id}', 'App\Http\Controllers\KecamatanPageController@hapus');


//Desa
Route::get('/admin/desa', 'App\Http\Controllers\DesaPageController@home');
Route::get('/admin/desa/tambah', 'App\Http\Controllers\DesaPageController@tambah');
Route::post('/admin/desa/tambah', 'App\Http\Controllers\DesaPageController@simpan');
Route::get('/admin/desa/ubah/{id}', 'App\Http\Controllers\DesaPageController@ubah');
Route::post('/admin/desa/update', 'App\Http\Controllers\DesaPageController@update');
Route::get('/admin/desa/hapus/{id}', 'App\Http\Controllers\DesaPageController@hapus');

// Route::get('/admin/pengalaman/home', 'App\Http\Controllers\pengalamanPageController@home');
// Route::get('/admin/pengalaman/tambah', 'App\Http\Controllers\pengalamanPageController@tambah');
// Route::post('/admin/pengalaman/tambah', 'App\Http\Controllers\pengalamanPageController@simpan');
// Route::get('/admin/pengalaman/ubah/{id}', 'App\Http\Controllers\pengalamanPageController@ubah');
// Route::post('/admin/pengalaman/update', 'App\Http\Controllers\pengalamanPageController@update');
// Route::get('/admin/pengalaman/hapus/{id}', 'App\Http\Controllers\pengalamanPageController@hapus');

Route::middleware('auth:admin')->group(function(){
    // Tulis routemu di sini.
  });
