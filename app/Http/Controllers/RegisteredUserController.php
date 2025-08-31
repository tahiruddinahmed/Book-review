<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    /**
     * Sign up user
     */
    public function store(Request $request) {
        $attributes =  $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => ['required', Password::min(6)->mixedCase()->letters()->numbers()->symbols(), 'confirmed']
        ]);

        // if user already exits 
        if(User::where('email', $request->email)->first()) {
            throw ValidationException::withMessages([
                'email' => 'You already have an account'
            ]);
        }

        // create user 
        $user = User::create($attributes);

        // log the user in 
        Auth::login($user);

        // Redirect the user 
        return redirect()->route('books.index');


    }
}
