<?php

namespace App\Http\Controllers;

use in;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
        // creating user
        $user = User::create($attr);

        // redirecting to home page
        return redirect('/users')->with('success', 'Your account has been created.');
    }
}
