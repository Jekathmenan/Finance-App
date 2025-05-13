<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class RegisterController extends Controller
{
    public function create() {
        return view('guests.register');
    }

    public function store() {
        // validating User Input
        $usersCount = User::all()->count();
        $attr = request()->validate([
            'name' => ['required', 'min:4', 'max:255'],
            'username' => [Rule::unique('users', 'username'), 'required', 'max:255'],
            'email' => [Rule::unique('users', 'email'), 'required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:15', 'confirmed']
        ]);

        // First user ever created should get the superadmin status
        $attr['role'] = $usersCount == 0 ? 'Superadmin' : 'User';
        // creating user
        $user = User::create($attr);

        // logging user in
        Auth::login($user);
    
        // redirecting to home page
        return redirect('/')->with('success', 'Your account has been created.');
    }
}
