<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupportTicketController;
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
    return view('backend.pages.dashboard');
})->middleware('auth')->name('admin_dashboard');

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('auth_login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {

        Route::controller(CustomerController::class)->prefix('customer')->group(function () {
            Route::get('/index', 'index')->name('customer.index');
            Route::get('/add_edit/{id?}','add_edit')->where('id', '.*')->name('customer.add_edit');
            Route::post('/store','store')->name('customer.store');
            Route::post('/update/{id}','update')->name('customer.update');
        });

        Route::controller(SupportTicketController::class)->prefix('support-ticket')->group(function () {
            Route::get('/index', 'index')->name('ticket.index');
            Route::get('/add', 'add')->name('ticket.add');
            Route::get('/details/{id}', 'details')->name('ticket.details');
            Route::post('/store', 'store')->name('ticket.store');
            Route::post('/reply/{id}', 'reply')->name('ticket.reply');
            Route::post('/close', 'ticketClose')->name('ticket.ticketClose');
        });
});





