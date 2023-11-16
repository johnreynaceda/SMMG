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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/create-new-account', function () {
    return view('new-account');
})->name('new-account');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'user-redirect'
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->account_type == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->account_type == 'patient') {
            return redirect()->route('patient.dashboard');
        } elseif (auth()->user()->account_type == 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif (auth()->user()->account_type == 'nurse') {
            return redirect()->route('nurse.dashboard');
        }
    })->name('dashboard');

});
