<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            if (Auth::user()->is_admin) {
                return redirect('dashboard');
            } else {
                return redirect('vitrine');
            }
            // 
        } else {

            return back()->withErrors(['email' => 'Email ou senha inválidos.']);
        }
    }

    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success' => 'Você foi deslogado.']);
    }
}
