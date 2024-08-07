<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        if(Auth::check()) {
            return redirect()->route('panel');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        if(!Auth::validate($request->only('email', 'password'))) {
            return redirect()->back()->withErrors('Credenciales incorrectas');
        }

        $user = Auth::getProvider()->retrieveByCredentials($request->only('email', 'password'));
        Auth::login($user);
        return redirect()->route('panel')->with('success', 'Bienvenido ' . $user->name);
    }
}