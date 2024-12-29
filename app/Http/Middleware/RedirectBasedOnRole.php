<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // dd(Auth::user()->role->name);

        switch ($user->role->name) {

            case 'doctor':
                return redirect('/doctor-page');
                break;
           
            case 'nurse':
                return redirect('/nurses');
                break;

            case 'cashier':
                return redirect('/cashier');
                break;

            case 'manager':
                return redirect('/manager');
                break;

            case 'patient':
                return redirect('/patients');
                break;

            case 'admin':
                return redirect('/doctors');
                break;

            case 'registrar':
                return redirect('/registrators');
                break;

            case 'worker':
                return redirect('/workers');
                break;

            default:
                return redirect('/login');
        }

        return $next($request);
    }
}
