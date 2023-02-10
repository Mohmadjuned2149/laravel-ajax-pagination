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