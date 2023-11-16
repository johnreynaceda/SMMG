<?php

Route::prefix('nurse')
    ->middleware(['auth', 'nurse'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('nurse.index');
        })->name('nurse.dashboard');
        Route::get('/patients', function () {
            return view('nurse.patients');
        })->name('nurse.patients');
        Route::get('/tasks', function () {
            return view('nurse.tasks');
        })->name('nurse.tasks');
    });
