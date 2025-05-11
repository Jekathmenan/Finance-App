<?php

namespace App\Http\Controllers;

use App\Models\TransferCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TransferCategory::all();
        return view('auth.categories.overview', [
            'categories' => $categories
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

        
        $category = new TransferCategory;
        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();
        
        return redirect()->intended('/accounts')->with('success', 'Konto aktualisiert');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id = null)
    {
        // find category
        $category = $id == null ? null : TransferCategory::findMany($id)->where('user_id', Auth::user()->id)->first();
        
        // return category editing form
        return view('auth.category.categoryform', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransferCategory $category)
    {
        // input validation
        $attributes = request()->validate([
            'type' => ['required', 'numeric'],
            'name' => ['required'],
            'starting_amount' =>['numeric'],
        ]);
        
        $attributes['starting_amount'] = $attributes['starting_amount'] *100;
        
        // update
        $category->update($attributes);

        // redirect to page
        return redirect()->intended('/accounts')->with('success', 'Konto aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransferCategory $category)
    {
        // delete the accoutn
        $category->delete();

        // redirect to page
        return redirect()->intended('/accounts')->with('warning', 'Konto gelöscht');
    }
}
