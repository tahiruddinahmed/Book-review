<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSessionController extends Controller
{
    /**
     * Login form view
     */
    public function create() {
        return view('auth.login');
    }
}
