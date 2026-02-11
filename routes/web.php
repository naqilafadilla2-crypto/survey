<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KontenSurveiController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DirektoratController;
use App\Http\Controllers\StatusPegawaiController;
use App\Http\Controllers\LamaBekerjaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Admin\AdminLaporanController;

// Default login route for auth middleware
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// ================= Pegawai (tanpa login) =================
// Halaman utama langsung ke list survei
Route::get('/', [SurveiController::class, 'index'])->name('home');

Route::get('/survei', [SurveiController::class, 'index'])->name('survei.index');
Route::get('/survei/create/{kontenId}', [SurveiController::class, 'create'])->name('survei.create');
Route::post('/survei', [SurveiController::class, 'store'])->name('survei.store');
Route::get('/survei/thank-you', [SurveiController::class, 'thankYou'])->name('survei.thank-you');
Route::get('/survei/{id}', [SurveiController::class, 'show'])->name('survei.show'); // Menampilkan hasil survei setelah submit

// ================= Admin (login) =================
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Survei Admin
    Route::get('/admin/survei/{id}', [AdminController::class, 'showSurvei'])->name('admin.survei.show');
    Route::delete('/admin/survei/{id}', [AdminController::class, 'destroySurvei'])->name('admin.survei.destroy');

    // Konten Survei
    Route::resource('admin/konten-survei', KontenSurveiController::class)->names([
        'index' => 'admin.konten-survei.index',
        'create' => 'admin.konten-survei.create',
        'store' => 'admin.konten-survei.store',
        'edit' => 'admin.konten-survei.edit',
        'update' => 'admin.konten-survei.update',
        'destroy' => 'admin.konten-survei.destroy',
    ]);

    // Toggle status konten survei
    Route::patch('admin/konten-survei/{id}/toggle-status', [KontenSurveiController::class, 'toggleStatus'])->name('admin.konten-survei.toggle-status');

    // Question management selection page
    Route::get('admin/questions', [QuestionController::class, 'selectKonten'])->name('admin.konten-survei.questions.select');

    // Question management nested under konten-survei
    Route::prefix('admin/konten-survei/{konten_survei}/questions')->name('admin.konten-survei.questions.')->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('index');
        Route::get('/create', [QuestionController::class, 'create'])->name('create');
        Route::post('/', [QuestionController::class, 'store'])->name('store');
        Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('edit');
        Route::put('/{question}', [QuestionController::class, 'update'])->name('update');
        Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('destroy');
    });

    // Pegawai
    Route::resource('admin/pegawais', PegawaiController::class)->names([
        'index' => 'admin.pegawais.index',
        'create' => 'admin.pegawais.create',
        'store' => 'admin.pegawais.store',
        'show' => 'admin.pegawais.show',
        'edit' => 'admin.pegawais.edit',
        'update' => 'admin.pegawais.update',
        'destroy' => 'admin.pegawais.destroy',
    ]);

    
    Route::resource('admin/direktorats', DirektoratController::class)->names([
        'index' => 'admin.direktorats.index',
        'create' => 'admin.direktorats.create',
        'store' => 'admin.direktorats.store',
        'show' => 'admin.direktorats.show',
        'edit' => 'admin.direktorats.edit',
        'update' => 'admin.direktorats.update',
        'destroy' => 'admin.direktorats.destroy',
    ]);

    // Status Pegawai
    Route::resource('admin/status-pegawais', StatusPegawaiController::class)->names([
        'index' => 'admin.status-pegawais.index',
        'create' => 'admin.status-pegawais.create',
        'store' => 'admin.status-pegawais.store',
        'show' => 'admin.status-pegawais.show',
        'edit' => 'admin.status-pegawais.edit',
        'update' => 'admin.status-pegawais.update',
        'destroy' => 'admin.status-pegawais.destroy',
    ]);

    // Lama Bekerja
    Route::resource('admin/lama-bekerjas', LamaBekerjaController::class)->names([
        'index' => 'admin.lama-bekerjas.index',
        'create' => 'admin.lama-bekerjas.create',
        'store' => 'admin.lama-bekerjas.store',
        'show' => 'admin.lama-bekerjas.show',
        'edit' => 'admin.lama-bekerjas.edit',
        'update' => 'admin.lama-bekerjas.update',
        'destroy' => 'admin.lama-bekerjas.destroy',
    ]);

    // Kategori
    Route::resource('admin/kategoris', KategoriController::class)->names([
        'index' => 'admin.kategoris.index',
        'create' => 'admin.kategoris.create',
        'store' => 'admin.kategoris.store',
        'show' => 'admin.kategoris.show',
        'edit' => 'admin.kategoris.edit',
        'update' => 'admin.kategoris.update',
        'destroy' => 'admin.kategoris.destroy',
    ]);

    // Laporan
    Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/admin/laporan/export', [AdminLaporanController::class, 'export'])->name('admin.laporan.export');
    Route::get('/admin/laporan/export-excel', [AdminLaporanController::class, 'exportExcel'])->name('admin.laporan.export-excel');
});
