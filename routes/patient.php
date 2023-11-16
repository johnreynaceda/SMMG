<?php

Route::prefix('patient')
    ->middleware(['auth', 'patient'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('patient.dashboard');
        Route::get('/about', function () {
            return view('about');
        })->name('about');
        Route::get('/contact', function () {
            return view('contact');
        })->name('contact');
        Route::get('/notification', function () {
            return view('notification');
        })->name('notification');
        Route::get('/account', function () {
            return view('account');
        })->name('account');
        Route::get('/appointment', function () {
            return view('appointment');
        })->name('appointment');

        Route::get('/get-appointment/{id}', function () {
            return view('get-appointment');
        })->name('get-appointment');
        Route::get('/submit-appointment', function () {
            return view('submit-appointment');
        })->name('submit-appointment');
        Route::get('/my-account', function () {
            return view('account');
        })->name('my-account');
        Route::get('/my-profile', function () {
            return view('my-profile');
        })->name('my-profile');
    });
