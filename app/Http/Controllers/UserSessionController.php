<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserSessionController extends Controller
{
    /**
     * Login form view
     */
    public function create() {
        return view('auth.login');
    }

    /**
     * Login 
     */
    public function store(Request $request) {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attemp to log in 
        if(!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'login' => 'Invalid Crendentials'
            ]);
        }

        // regenrate session 
        $request->session()->regenerate();

        // redirect
        return redirect()->route('books.index');

    }

    /**
     * Logout the user
     */
    public function destroy() {
        Auth::logout();

        return redirect()->route('books.index');
    }
}
