<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transfer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function createAccounts()
    {
        $accounts = Account::all();
        $recentTransactions = Transfer::with(['accountFrom', 'accountTo', 'category'])
            ->where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();


        return view('auth.dashboard.overview', [
            'accounts' => $accounts,
            'recentTransactions' => $recentTransactions
        ]);
    }
}
