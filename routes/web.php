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
])->group(function () {
    Route::get('/dashboard', function () {

        switch (auth()->user()->account_type) {
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;
            case 'patient':
                return redirect()->route('patient.dashboard');
                break;

            default:
                # code...
                break;
        }
    })->name('dashboard');

});