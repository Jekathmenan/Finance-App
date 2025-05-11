<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class SessionController extends Controller
{
    public function create() 
    {
        return view('guests.login');
    }

    public function store(Request $request) //: RedirectResponse
    {
        // input validation
        $attributes = request()->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        // attempt to authenticate and log in the user
        if (Auth::attempt($attributes)) {
            // regenerating Session Variables
            $request->session()->regenerate();

            // redirect with a success message
            return redirect()->intended('/')->with('success', 'Welcome Back!');
        }

        // auth failed
        throw ValidationException::withMessages([
            'email' => 'The provided credentials could not be verified'
        ]); 
    }

    public function resetPassword() 
    {
        // TODO: Implement this part
        // input validation
        $attributes = request()->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $auth = Auth::login($attributes);
        // attempt to authenticate and log in the user
        if (Auth::attempt($attributes)) {
            //redirect with a success message
            return redirect('/')->with('success', 'Welcome Back!');
        }

        // auth failed
        throw ValidationException::withMessages([
            'email' => 'The provided credentials could not be verified'
        ]);   
    }

    public function destroy() 
    {
        // logging out the user
        auth()->logout();

        // redirecting user to home page
        return redirect('/')->with('success', 'You have been logged out successfully');
    }
}
