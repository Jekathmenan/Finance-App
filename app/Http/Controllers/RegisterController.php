<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function create()
    {
        return view('guests.register');
    }

    public function resetPasswordInit()
    {
        return view('guests.reset_password');
    }

    public function resetPassword($code, $code2, Request $request)
    {
        $reset_challenge = base64_decode($code);
        $email = base64_decode($code2);
        // dd($user);
        $user = User::where('email', $email)->first();

        if ($user->reset_challenge == $reset_challenge) {
            // $request->session()->put('confirmed', 'true');
            Session::put('confirmed', 'true');
            //dd('setting Session id ' . Session::get('confirmed'));
            return view('guests.reset_password_form', [
                'username' => $email
            ]);
        }

        return redirect('/login')->with('error', 'Bitte melden Sie sich an.');
    }

    public function store()
    {
        // validating User Input
        $usersCount = User::all()->count();
        $attr = request()->validate([
            'name' => ['required', 'min:4', 'max:255'],
            'username' => [Rule::unique('users', 'username'), 'required', 'max:255'],
            'email' => [Rule::unique('users', 'email'), 'required', 'email', 'max:255'],
            'password' => ['required', 'min:8', 'max:30', 'confirmed']
        ]);

        // First user ever created should get the superadmin status
        $attr['role'] = $usersCount == 0 ? 'Superadmin' : 'User';
        $attr['status'] = 0;
        // creating user
        $user = User::create($attr);

        // user needs to activate his account first
        $email = $attr['email'];

        $messageData = [
            'email' => $email,
            'name' => $attr['name'],
            'code' => base64_encode($email)
        ];

        Mail::send(
            'mail.register_confirmation',
            $messageData,
            function ($message) use ($email) {
                $message->to($email)->subject('Bitte bestätigen Sie die Registration');
            }
        );

        // redirecting to login page
        return redirect('/login')->with('success', 'Konto erstellt. Bitte Email überprüfen.');
    }

    public function confirmAccount($code)
    {
        $email = base64_decode($code);
        $userExists = User::where('email', $email)->count() > 0;

        if ($userExists) {
            $user = User::where('email', $email)->first();
            if ($user->status == 1) {
                // Redirect user to login page
                return redirect('/login')->with('warning', 'Konto wurde bereits aktiviert. Bitte anmelden!');
            } else {
                $user->status = 1;
                $user->save();
                return redirect('/login')->with('success', 'Konto aktiviert. Bitte anmelden!');
            }
        } else {
            abort(404);
        }
    }
}
