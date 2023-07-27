<?php

Route::prefix('patient')
    ->middleware(['auth'])
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
    });
