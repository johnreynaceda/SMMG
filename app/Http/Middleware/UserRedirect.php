<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->account_type == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->account_type == 'patient') {
            return redirect()->route('patient.dashboard');
        } elseif (auth()->user()->account_type == 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif (auth()->user()->account_type == 'nurse') {
            return redirect()->route('nurse.dashboard');
        }
    }
}
