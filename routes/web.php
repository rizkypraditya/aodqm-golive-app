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
        ->middleware('roles:admin,users,mitra');

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
        Route::namespace('User')->prefix('pengguna')->name('user.')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::get('/tambah', Create::class)->name('create');
            Route::get('/{id}/sunting', Edit::class)->name('edit');
        });
    });

    /**
     *  report
     */
    Route::namespace('Report')->middleware('roles:admin,user,mitra')->prefix('laporan')->name('report.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/tambah', Create::class)->name('create');
        Route::get('/{id}/sunting', Edit::class)->name('edit');
        Route::get('/{id}/revisi', Revision::class)->name('revision');
        Route::get('/{id}/download', Download::class)->name('download');
    });

    /**
     *  revision
     */
    Route::namespace('Revision')->middleware('roles:admin,user,mitra')->prefix('revisi')->name('revision.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/{id}/sunting', Edit::class)->name('edit');
        Route::get('/{id}/detail', Detail::class)->name('detail');
        Route::get('/{id}/download', Download::class)->name('download');
    });

    /**
     * setting
     */
    Route::prefix('pengaturan')->name('setting.')->middleware('roles:admin,user,mitra')->namespace('Setting')->group(function () {
        Route::redirect('/', 'pengaturan/aplikasi');

        /**
         * Profile
         */
        Route::prefix('profil')->name('profile.')->group(function () {
            Route::get('/', Profile\Index::class)->name('index');
        });

        /**
         * Account
         */
        Route::prefix('akun')->name('account.')->group(function () {
            Route::get('/', Account\Index::class)->name('index');
        });
    });
});
