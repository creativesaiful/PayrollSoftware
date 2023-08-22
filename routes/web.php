<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveController;
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

    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::middleware(['auth'])->group(function () {
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
    Route::get('/leave/create', [LeaveController::class, 'create'])->name('leave.create');
    Route::post('/leave', [LeaveController::class, 'store'])->name('leave.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
    Route::patch('/leave/{id}/approve', [LeaveController::class, 'approve'])->name('leave.approve');
    Route::patch('/leave/{id}/reject', [LeaveController::class, 'reject'])->name('leave.reject');
    // ... other routes ...
});
