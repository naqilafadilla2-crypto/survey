<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KontenSurveiController;

/*
|--------------------------------------------------------------------------
| ROUTE LOGIN DEFAULT (WAJIB ADA UNTUK MIDDLEWARE AUTH)
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');



/*
|--------------------------------------------------------------------------
| ROUTE PEGAWAI / PUBLIK (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', [SurveiController::class, 'index'])
    ->name('survei.index');

Route::get('/survei/create', [SurveiController::class, 'create'])
    ->name('survei.create');

Route::post('/survei', [SurveiController::class, 'store'])
    ->name('survei.store');

Route::get('/survei/{id}', [SurveiController::class, 'show'])
    ->name('survei.show');


/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'login'])
    ->name('admin.login.post');

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN AREA (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    // Lihat detail survei
    Route::get('/survei/{id}', [AdminController::class, 'showSurvei'])
        ->name('survei.show');

    // Hapus survei
    Route::delete('/survei/{id}', [AdminController::class, 'destroySurvei'])
        ->name('survei.destroy');

    // Kelola pertanyaan survei
    Route::resource('konten-survei', KontenSurveiController::class);
});
