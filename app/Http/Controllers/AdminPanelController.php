<?php

namespace App\Http\Controllers;

use in;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminPanelController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function createAdminPanel()
    {
        return view('auth.adminpanel.overview');
    }

    public function showUsers()
    {
        $users = User::all();
        return view('auth.adminpanel.useroverview', [
            'users' => $users,
        ]);
    }

    public function editUser($id = null)
    {
        if ($id == null) {
            return view('auth.adminpanel.userform');
        }

        $user = User::findMany($id)->first();

        return view('auth.adminpanel.userform', [
            'user' => $user,
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

    public function storeUser()
    {
        // validating User Input
        $usersCount = User::all()->count();
        $attr = request()->validate([
            'name' => ['required', 'min:4', 'max:255'],
            'username' => [Rule::unique('users', 'username'), 'required', 'max:255'],
            'email' => [Rule::unique('users', 'email'), 'required', 'email', 'max:255']
        ]);

        // First user ever created should get the superadmin status
        $attr['role'] = $usersCount == 0 ? 'Superadmin' : 'User';
        $attr['password'] = null;
        $attr['status'] = 0;
        $code = $this->rand_char(25);
        $attr['reset_challenge'] = $code;

        // creating user
        $user = User::create($attr);
        $user->reset_challenge = $code;
        $user->save();
        $email = $user->username;

        //
        $messageData = [
            'email' => $email,
            'name' => $user->name,
            'code' => base64_encode($code),
            'code2' => base64_encode($user->username)
        ];

        Mail::send(
            'mail.confirm_pw_reset',
            $messageData,
            function ($message) use ($email) {
                $message->to($email)->subject('Account created for you');
            }
        );
        //dd($code, base64_encode($code), base64_decode(base64_encode($code)));
        // redirecting to home page
        return redirect('/users')->with('success', 'User account has been created.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUser(Request $request, User $user)
    {
        // TODO: Input validation
        $attributes = request()->validate([
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email']
        ]);

        //$attributes['date'] = date("Y-m-d", strtotime($attributes['date']));

        // update
        $user->update($attributes);
        return redirect()->intended('/users')->with('warning', 'Benutzer aktualisiert');
    }
}
