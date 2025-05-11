<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accounts = Account::all();
        return view('auth.accounts.overview', [
            'accounts' => $accounts
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: THERE'S SOME ERROR WITH STORING NEW ACCOUNT
        // TODO: input validation
        $attributes = request()->validate([
            'type' => ['required'],
            'name' => ['required']
        ]);

        
        $account = new Account;
        $account->type = $request->type;
        $account->name = $request->name;
        $account->starting_amount = $request->starting_amount * 100;
        $account->description = $request->description;
        $account->user_id = Auth::id();
        $account->save();
        
        return redirect()->intended('/accounts')->with('success', 'Konto aktualisiert');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id = null)
    {
        // find account
        $account = $id == null ? null : Account::findMany($id)->where('user_id', Auth::user()->id)->first();
        
        // return account editing form
        return view('auth.accounts.accountform', [
            'account' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Account $account)
    {
        // input validation
        $attributes = request()->validate([
            'type' => ['required', 'numeric'],
            'name' => ['required'],
            'starting_amount' =>['numeric'],
        ]);
        
        $attributes['starting_amount'] = $attributes['starting_amount'] *100;
        
        // update
        $account->update($attributes);

        // redirect to page
        return redirect()->intended('/accounts')->with('success', 'Konto aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        // delete the accoutn
        $account->delete();

        // redirect to page
        return redirect()->intended('/accounts')->with('warning', 'Konto gelöscht');
    }
}
