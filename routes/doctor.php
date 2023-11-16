<?php

Route::prefix('doctor')
    ->middleware(['auth', 'doctor'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('doctor.index');
        })->name('doctor.dashboard');
        Route::get('/my-calendar', function () {
            return view('doctor.calendar');
        })->name('doctor.calendar');
        Route::get('/my-appointments', function () {
            return view('doctor.appointments');
        })->name('doctor.appointments');



    });
