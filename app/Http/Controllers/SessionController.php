<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

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

        $user = User::where('email', $attributes['email'])->first();

        // Check if user is active
        if ($user->status != 1) {
            // auth failed
            throw ValidationException::withMessages([
                'email' => 'Benutzer konnte nicht validiert werden.'
            ]);
        }

        // attempt to authenticate and log in the user
        if (Auth::attempt($attributes)) {
            // regenerating Session Variables
            $request->session()->regenerate();

            // redirect with a success message
            return redirect()->intended('/')->with('success', 'Welcome Back!');
        }

        // auth failed
        throw ValidationException::withMessages([
            'email' => 'Benutzer konnte nicht validiert werden.'
        ]);
    }

    private function rand_char($length)
    {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(mt_rand(33, 126));
        }
        return $random;
    }

    public function resetPasswordInit()
    {
        // User can enter his username 
        // --> If User exists and is active, reset confirmation link is sent to email
        // If provided code is valid, user can reset his password
        $attributes = request()->validate([
            'username' => ['required']
        ]);

        $user = User::where('username', $attributes['username'])->first();

        if ($user === null || $user->status == -1) {
            return redirect('/register')->with('error', 'Benutzerkonto existiert nicht oder ist nicht aktiv.');
        }

        // Send verification code to User
        $code = $this->rand_char(25);
        $user->reset_challenge = $code;
        $user->save();
        $email = $user->username;

        $messageData = [
            'email' => $user->email,
            'name' => $user->name,
            'code' => base64_encode($code),
            'code2' => base64_encode($user->email)
        ];

        Mail::send(
            'mail.confirm_pw_reset',
            $messageData,
            function ($message) use ($email) {
                $message->to($email)->subject('Kennwort zurücksetzen?');
            }
        );

        return redirect('/forgot-password')->with('success', 'Bitte E-Mail Postfach überprüfen!');
    }

    public function resetPassword()
    {
        $attributes = request()->validate([
            'username' => ['required'],
            'password' => ['required', 'min:8', 'max:30', 'confirmed']
        ]);

        $user = User::where('username', $attributes['username'])->first();

        $user->password = $attributes['password'];
        $user->reset_challenge = null;

        if ($user->status == -1) {
            $user->status = 1;
        }

        $user->save();

        Session::pull('confirmed', 'default');

        if ($user === null || $user->status == -1) {
            return redirect('/register')->with('error', 'Benutzerkonto existiert nicht oder ist nicht aktiv.');
        }

        Auth::login($user);
        return redirect('/')->with('success', 'Kennwort erfolgreich geändert!');
    }

    public function destroy()
    {
        // logging out the user
        auth()->logout();

        // redirecting user to home page
        return redirect('/')->with('success', 'You have been logged out successfully');
    }
}
