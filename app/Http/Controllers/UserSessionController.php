<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSessionController extends Controller
{
    /**
     * Login form view
     */
    public function create() {
        return view('auth.login');
    }

    /**
     * Logout the user
     */
    public function destroy() {
        Auth::logout();

        return redirect()->route('books.index');
    }
}
