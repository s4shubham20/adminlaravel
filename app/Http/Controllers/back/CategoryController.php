<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\back\Category;
use App\Models\back\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        $trash = Category::onlyTrashed()->count();
        return view('back.category.index',['categories' => $category, 'trash' => $trash]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('back.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'status' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category = $category->save();
        return redirect()->route('category.index')->with('success', 'You have successfully submitted');

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
        $category = Category::find($id);
        return view('back.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $eid)
    {
        $id = Crypt::decryptString($eid);

        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'status' => 'required',
            'slug' => 'required|unique:categories,slug,'.$id
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();
        return redirect()->back()->with('success','You have successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $eid)
    {
        $id = Crypt::decryptString($eid);
        $category = Category::find($id);
        $categoryId =$category->id;
        $subcategory = Subcategory::where('category_id',$categoryId)->get();
        if(count($subcategory) > 0){
            return redirect()->back()->with('success', 'You can\'t delete this category');
        }else{
            $category->destroy($id);
            return redirect()->back()->with('success', 'You have successfully deleted the record');
        }
        
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('back.category.trash-category.index', compact('categories'));
    }

    public function restore($eid)
    {
        $id = Crypt::decryptString($eid);
        Category::onlyTrashed()->find($id)->restore();
        return redirect()->route('category.index')->with('success','You have successfully restored');
    }

    public function forcedelete($eid)
    {
        $id = Crypt::decryptString($eid);
        $category = Category::onlyTrashed()->find($id);
        $categoryId =$category->id;
        $subcategory = Subcategory::where('category_id',$categoryId)->get();
        if(count($subcategory) > 0){
            return redirect()->back()->with('success', 'You can\'t delete this category');
        }else{
            $category->forceDelete();
            return redirect()->back()->with('success', 'You have successfully permanently deleted the record');
        }

    }
}
