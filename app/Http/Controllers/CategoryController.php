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
            'name' => ['required']
        ]);

        
        $category = new TransferCategory;
        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();
        
        return redirect()->intended('/categories')->with('success', 'Kategorie angelegt');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id = null)
    {
        // find category
        $category = $id == null ? null : TransferCategory::findMany($id)->where('user_id', Auth::user()->id)->first();
        
        // return category editing form
        return view('auth.categories.categoryform', [
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
            'name' => ['required']
        ]);

        // update
        $category->update($attributes);

        // redirect to page
        return redirect()->intended('/categories')->with('success', 'Kategorie aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransferCategory $category)
    {
        // delete the accoutn
        $category->delete();

        // redirect to page
        return redirect()->intended('/categories')->with('warning', 'Kategorie gelöscht');
    }
}
