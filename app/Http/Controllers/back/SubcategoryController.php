<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\back\Category;
use App\Models\back\Subcategory;
use Illuminate\Support\Facades\Crypt;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subcategory = Subcategory::with('category')->get();
        $trash = Subcategory::onlyTrashed()->count();
        return view('back.subcategory.index',['subacategories' => $subcategory, 'trash' => $trash]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $category = Category::all();
        return view('back.subcategory.create',['categories' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subcategories',
            'slug' => 'required|unique:subcategories',
            'status' => 'required',
            'category_id' => 'required'
        ]);

        $subcategory = new Subcategory;
        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->status = $request->status;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        return redirect()->route('subcategory.index')->with('success','You have successfully added new record');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $eid)
    {
        $id = Crypt::decryptString($eid);
        $categories = Category::all();
        $subcategory = Subcategory::find($id);
        return view('back.subcategory.edit', compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $eid)
    {
        $id = Crypt::decryptString($eid);

        $request->validate([
            'name' => 'required|unique:subcategories,name,'.$id,
            'slug' => 'required|unique:subcategories,name,'.$id,
            'status' => 'required',
            'category_id' => 'required'
        ]);
        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->category_id = $request->category_id;
        $subcategory->status = $request->status;
        $subcategory->save();
        return redirect()->back()->with('success', 'You have successfully udpated');

    
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $eid)
    {
        $id = Crypt::decryptString($eid);
        Subcategory::destroy($id);
        return redirect()->route('subcategory.trash')->with('success', 'You have successfully moved this in trash');

    }

    public function trash()
    {
        $subacategories = Subcategory::with('category')->onlyTrashed()->get();
        return view('back.subcategory.trash-subcategory.index', compact('subacategories'));
    }

    public function restore($eid)
    {
        $id = Crypt::decryptString($eid);
        Subcategory::onlyTrashed()->find($id)->restore();
        return redirect()->route('subcategory.index')->with('success','You have successfully restore');
    }

    public function forcedelete($eid)
    {
        $id = Crypt::decryptString($eid);
        Subcategory::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'You have successfully permanent deleted this record!');
    }
}
