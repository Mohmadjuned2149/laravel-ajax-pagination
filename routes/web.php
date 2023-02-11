<?php

use App\Http\Controllers\EmployeeController;
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

Route::get('/', [EmployeeController::class, 'getData'])->name('get.data');
Route::post('/ajex-data', [EmployeeController::class, 'getAjaxData'])->name('ajax.data');
Route::get('/total_records', [EmployeeController::class, 'getTotalData'])->name('total.records');
Route::get('/load-more', [EmployeeController::class, 'loadMore'])->name('load.more');
Route::post('/load-more', [EmployeeController::class, 'getLoadMore'])->name('load.more');
Route::get('/infinite-load', [EmployeeController::class, 'infiniteLoad'])->name('infinite.load');
Route::post('/infinite-load', [EmployeeController::class, 'getInfiniteLoadData'])->name('infinite.load');
Route::post('/search', [EmployeeController::class, 'searchData'])->name('search');