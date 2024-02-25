<?php

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


Route::redirect('/', '/login');

Route::middleware('auth', 'verified', 'force.logout')->namespace('App\Livewire')->group(function () {

    /**
     * beranda / home
     */
    Route::get('beranda', Home\Index::class)->name('home')
        ->middleware('roles:admin,users');

    /**
     * master
     */
    Route::namespace('Master')->middleware('roles:admin')->prefix('master')->name('master.')->group(function () {
        Route::redirect('/', '/master/mitra');
        /**
         * mitra
         */
        Route::namespace('Mitra')->prefix('mitra')->name('mitra.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('/tambah', Create::class)->name('create');
            Route::get('/{id}/sunting', Edit::class)->name('edit');
        });

        /**
         * user
         */
        Route::namespace('User')->prefix('user')->name('user.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('/tambah', Create::class)->name('create');
            Route::get('/{id}/sunting', Edit::class)->name('edit');
        });
    });
});
