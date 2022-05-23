<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\catatanPerjalananController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\dashboardProfileController;
use App\Http\Controllers\dashboardPasswordController;
use App\Http\Controllers\dashboardAlbumController;

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

Route::middleware(['auth', 'verified'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    // DASHBOARD SETTING PROFILE
    Route::get('/dashboard/setting', [dashboardProfileController::class, 'edit'])->name('set-profile');
    Route::patch('/dashboard/setting/updateProfile', [dashboardProfileController::class, 'update'])->name('set-profile-update');
    Route::patch('/dashboard/setting/updateAvatar', [dashboardProfileController::class, 'avatar'])->name('set-avatar-update');


    // DASHBOARD SETTING PASSWORD
    Route::get('/dashboard/setting/change-password', [dashboardPasswordController::class, 'edit'])->name('set-password');
    Route::patch('/dashboard/setting/change-password', [dashboardPasswordController::class, 'update']);

    // DASHBOARD CATATAN
    Route::resource('/dashboard/catatan', catatanPerjalananController::class);
    Route::post('/dashboard/catatan/chekout/{id}', [catatanPerjalananController::class, 'update_chekout'])->name('chekout');
    Route::get('/dashboard/cari', [catatanPerjalananController::class, 'cari'])->name('cari');
    Route::get('/dashboard/sortfirst', [catatanPerjalananController::class, 'sortfirst'])->name('sortfirst');
    Route::get('/dashboard/sortlast', [catatanPerjalananController::class, 'sortlast'])->name('sortlast');

    // DASHBOARD ALBUM
    Route::resource('/dashboard/album', dashboardAlbumController::class);


});

require __DIR__.'/auth.php';
