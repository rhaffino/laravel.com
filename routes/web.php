<?php

use App\Http\Controllers\SiswaController;
use App\Models\Siswa;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute yang memerlukan otentikasi
Route::middleware('auth')->group(function () {
    Route::get('/siswa', [SiswaController::class, 'tampil'])->name('siswa.tampil');
    Route::get('/siswa/tambah', [SiswaController::class, 'tambah'])->name('siswa.tambah');
    Route::post('/siswa/submit', [SiswaController::class, 'submit'])->name('siswa.submit');
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::post('/siswa/{Rid}/update', [SiswaController::class, 'update'])->name('siswa.update');
    Route::post('/siswa/{Rid}/delete', [SiswaController::class, 'delete'])->name('siswa.delete');
});

require __DIR__.'/auth.php';

