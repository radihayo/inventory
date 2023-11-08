<?php

use App\Http\Controllers\barangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\jenisController;
use App\Http\Controllers\keluarController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\lokasiController;
use App\Http\Controllers\masukController;
use App\Http\Controllers\merekController;
use App\Http\Controllers\pengaturanController;
use App\Http\Controllers\satuanController;
use App\Http\Controllers\userController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [loginController::class, "index"]);
Route::get('/login', [loginController::class, "index"])->name('login')->middleware('guest');
Route::post('/authentification', [loginController::class, "authentification"])->middleware('guest');
Route::post('/logout', [loginController::class, "logout"]);

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'all']);
Route::get('/home', [dashboardController::class, 'index'])->middleware(['auth', 'all']);


Route::get('/barang/read', [barangController::class, 'read'])->name('barang.read')->middleware(['auth', 'all']);
Route::resource('/barang', barangController::class)->middleware(['auth', 'all']);

Route::get('/masuk/read', [masukController::class, 'read'])->name('masuk.read')->middleware(['auth', 'all']);
Route::resource('/masuk', masukController::class)->middleware(['auth', 'all']);

Route::get('/keluar/read', [keluarController::class, 'read'])->name('keluar.read')->middleware(['auth', 'all']);
Route::resource('/keluar', keluarController::class)->middleware(['auth', 'all']);

Route::get('/jenis/read', [jenisController::class, 'read'])->name('jenis.read')->middleware(['auth', 'all']);
Route::resource('/jenis', jenisController::class)->middleware(['auth', 'all']);

Route::get('/merek/read', [merekController::class, 'read'])->name('merek.read')->middleware(['auth', 'all']);
Route::resource('/merek', merekController::class)->middleware(['auth', 'all']);

Route::get('/satuan/read', [satuanController::class, 'read'])->name('satuan.read')->middleware(['auth', 'all']);
Route::resource('/satuan', satuanController::class)->middleware(['auth', 'all']);

Route::get('/lokasi/read', [lokasiController::class, 'read'])->name('lokasi.read')->middleware(['auth', 'all']);
Route::resource('/lokasi', lokasiController::class)->middleware(['auth', 'all']);

Route::get('/user/read', [userController::class, 'read'])->name('user.read')->middleware(['auth', 'admin']);
Route::resource('/user', userController::class)->middleware(['auth', 'admin']);

Route::post('/pengaturan/upload', [pengaturanController::class, "upload"])->name('pengaturan.upload')->middleware(['auth', 'all']);
Route::get('/pengaturan/reload', [pengaturanController::class, "reload"])->name('pengaturan.reload')->middleware(['auth', 'all']);
Route::get('/pengaturan/reload_sidebar', [pengaturanController::class, "reload_sidebar"])->name('pengaturan.reload_sidebar')->middleware(['auth', 'all']);
Route::get('/pengaturan/read', [pengaturanController::class, "read"])->name('pengaturan.read')->middleware(['auth', 'all']);
Route::resource('/pengaturan', pengaturanController::class)->middleware(['auth', 'all']);

Route::get('image-crop', [pengaturanController::class, "imageCrop"]);
Route::post('image-crop', [pengaturanController::class, "imageCropPost"])->name("imageCrop");
