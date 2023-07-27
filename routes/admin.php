<?php

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.index');
        })->name('admin.dashboard');
        Route::get('/doctors', function () {
            return view('admin.doctors');
        })->name('admin.doctors');
        Route::get('/nurses', function () {
            return view('admin.nurses');
        })->name('admin.nurses');
        Route::get('/medtech', function () {
            return view('admin.medtech');
        })->name('admin.medtech');

    });