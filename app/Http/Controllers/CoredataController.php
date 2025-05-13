<?php

namespace App\Http\Controllers;

use App\Models\TransferType;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoredataController extends Controller
{
    /**
     * 
     */
    public function create () {
        return view('auth.coredata.overview'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createTransferTypes()
    {
        $transferTypes = TransferType::all();
        return view('auth.coredata.overview_transfertypes', [
            'data' => $transferTypes
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editTransferTypes($id = null)
    {
        // find account
        $transferType = $id == null ? null : TransferType::findMany($id)->where('user_id', Auth::user()->id)->first();
        
        // return account editing form
        return view('auth.coredata.transferTypeForm', [
            'transferType' => $transferType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTransferType(Request $request)
    {
        // TODO: THERE'S SOME ERROR WITH STORING NEW ACCOUNT
        // TODO: input validation
        $attributes = request()->validate([
            'name' => ['required', 'alpha_num']
        ]);
        
        $transferType = new TransferType;
        $transferType->name = $request->name;
        $transferType->user_id = Auth::id();
        $transferType->save();
        
        return redirect()->intended('/transfer-types')->with('success', 'Buchungstyp gespeichert');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTransferType(TransferType $transferType)
    {
        // input validation
        $attributes = request()->validate([
            'name' => ['required'],
        ]);

        // update
        $transferType->update($attributes);

        // redirect to page
        return redirect()->intended('/transfer-types')->with('success', 'Buchungstyp gespeichert');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyTransferType(TransferType $transferType)
    {
        // delete the accoutn
        $transferType->delete();

        // redirect to page
        return redirect()->intended('/transfer-types')->with('warning', 'Buchungstyp gelöscht');
    }
}
