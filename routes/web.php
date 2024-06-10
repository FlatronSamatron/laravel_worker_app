<?php

use App\Http\Controllers\WorkerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(WorkerController::class)->prefix('workers')->group(function () {
    Route::get('/','index')->name('worker.index');

    Route::post('/', 'store')->name('worker.store');
    Route::patch('/{worker}', 'update')->name('worker.update');
    Route::delete('/{worker}', 'delete')->name('worker.delete');

    Route::get('/create', 'create')->name('worker.create');
    Route::get('/{worker}/edit', 'edit')->name('worker.edit');

    Route::get('/{worker}',  'show')->name('worker.show');
});

//Route::get('/workers', [WorkerController::class, 'index'])->name('worker.index');
//
//Route::get('/workers/create', [WorkerController::class, 'create'])->name('worker.create');
//Route::post('/workers', [WorkerController::class, 'store'])->name('worker.store');
//
//Route::get('/workers/update/{id}', [WorkerController::class, 'update'])->name('worker.update');
//Route::get('/workers/delete/{id}', [WorkerController::class, 'delete'])->name('worker.delete');
//Route::get('/workers/{worker}', [WorkerController::class, 'show'])->name('worker.show');
