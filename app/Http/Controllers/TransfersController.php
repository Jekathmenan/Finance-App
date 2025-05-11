<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\TransferCategory;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransfersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all Accounts
        $transfers = Transfer::with(['category', 'accountFrom'])->get();
        
        return view('auth.transfers.overview', [
            'transfers' => $transfers
        ]); 
    }

    public function edit ($id = null) 
    {
        $transfer_categories = TransferCategory::all();
        $accounts = Account::all();
        // dd($transfer_categories);
        if ($id == null) {

            return view('auth.transfers.transferNew', [
                'categories' => $transfer_categories,
                'accounts' => $accounts
            ]);
        }

        $transfer = $id == null ? null : Transfer::findMany($id)->where('users_id', Auth::user()->id)->first();
        

        // return transfer editing form
        return view('auth.transfers.transferform', [
            'transfer' => $transfer,
            'categories' => $transfer_categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Input validation and tests

        $transfer = new Transfer;
        $transfer->type = $request->type;
        $transfer->note = $request->note;
        $transfer->date = date("Y-m-d", strtotime($request->date));
        $transfer->repeattype = $request->repeattype;
        $transfer->amount = $request->amount * 100;
        $transfer->category = $request->category;
        $transfer->account_from = $request->accountFrom;
        $transfer->account_to = $request->accountTo;
        $transfer->users_id = Auth::id();
        $transfer->description = $request->description;

        $transfer->save();

        return redirect()->intended('/transfers')->with('success', 'Transfer eingefügt');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transfer $transfer)
    {
        //
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transfer $transfer)
    {
        // TODO: Input validation
        $attributes = request()->validate([
            'type' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'description' => ['nullable']
        ]);

        $attributes['date'] = date("Y-m-d", strtotime($attributes['date']));
        
        // update
        $transfer->update($attributes);
        return redirect()->intended('/transfers')->with('success', 'Transfer aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
