<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store() {
        $attributes = request()->validate([
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255'
        ]);

        User::create($attributes);

        auth()->login($user);

        return redirect('/')->with('success', 'Konto erfolgreich angelegt.');
    }
}
