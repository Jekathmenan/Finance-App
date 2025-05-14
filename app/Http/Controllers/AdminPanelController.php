<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

}
