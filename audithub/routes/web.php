<?php
use App\Http\Controllers\TelkomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MitraController;

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


Route::get('/', [LoginController::class,'index']);
Route::post('/', [LoginController::class,'login']);

Route::get('/playground', function() {
    return view('playground');
});

Route::get('add', [TelkomController::class,'add']);

Route::get('report', [MitraController::class,'report' ]);






