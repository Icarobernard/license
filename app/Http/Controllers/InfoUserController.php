<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'required_with:current_password', 'string', 'min:8', 'confirmed'],
        ]);
    
       
       $test= $user->update([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            // 'phone' => $attributes['phone'],
            // 'location' => $attributes['location'],
            // 'about_me' => $attributes['about_me'],
        ]);
        if ($request->filled('new_password')) {
            $user->update(['password' => Hash::make($request->new_password)]);
        }
    
        return redirect('/user-profile')->with('success', 'Perfil atualizado com sucesso!');
    }
    
}
