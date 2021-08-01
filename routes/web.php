<?php

use App\Http\Controllers\AdminbooksController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\EmployesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// Route::get('/', function () {
//     return view('user.books');
// });



Route::get('/', [BooksController::class, 'index'])->name('index');
Route::get('/bukutamu', [BooksController::class, 'create'])->name('bukutamu');
Route::post('/bukutamu', [BooksController::class, 'store'])->name('simpanbukutamu');
Route::get('/books/export/', [BooksController::class, 'export'])->name('export');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/data', [BooksController::class, 'show'])->name('data');
    Route::get('/bukutamu/{book}/edit', [AdminbooksController::class, 'edit'])->name('admin_edit');
    Route::get('/bukutamu/create', [AdminbooksController::class, 'create'])->name('admin_create');
    Route::post('/data', [AdminbooksController::class, 'store'])->name('admin_store');
    Route::put('/bukutamu/{book}', [AdminbooksController::class, 'update'])->name('admin_update');
    Route::delete('/bukutamu/{book}', [AdminbooksController::class, 'destroy'])->name('admin_delete');
    Route::get('/bukutamu/{book}', [AdminbooksController::class, 'show'])->name('admin_detail');

    Route::get('/employe', [EmployesController::class, 'index'])->name('pegawai_index');
    Route::get('/employe/{employe}/edit', [EmployesController::class, 'edit'])->name('pegawai_edit');
    Route::put('/employe/{employe}', [EmployesController::class, 'update'])->name('pegawai_update');
    Route::get('/employe/{employe}/detail', [EmployesController::class, 'show'])->name('pegawai_detail');
    Route::get('/employe/create', [EmployesController::class, 'create'])->name('pegawai_create');
    Route::post('/employe/create', [EmployesController::class, 'store'])->name('pegawai_store');
    Route::delete('/employe/{employe}', [EmployesController::class, 'destroy'])->name('pegawai_delete');
});

Auth::routes();

Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
