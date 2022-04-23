<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinmarketCapAPIController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/how-it-works', [DashboardController::class, 'how_it_works'])->middleware(['auth'])->name('how-it-works');
Route::get('/donation', [DashboardController::class, 'donation'])->middleware(['auth'])->name('donation');
Route::get('test-api-key', [CoinmarketCapAPIController::class, 'testKey'])->middleware(['auth'])->name('test-api-key');

Route::get('change-password', [UserController::class, 'credentialsPage'])->name('credentials-page');
Route::patch('change-password', [UserController::class, 'credentials'])->name('change-password');

Route::get('/docs/coinmarketcap-api-key', function() {
    return view('cpc_api_key');
})->middleware(['auth'])->name('cpc-api-key');

Route::get('latest-price', [CoinmarketCapAPIController::class, 'latest']);

Route::resource('/user', UserController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
