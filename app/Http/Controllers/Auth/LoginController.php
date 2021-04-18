<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'role' => 'required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('role', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }
        return redirect()->route('home')->with('status', 'Bienvenu ! Vous êtes connecté ...');
    }
}
