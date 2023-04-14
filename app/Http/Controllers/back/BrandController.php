<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\back\{Category, Subcategory, Brand};
use App\Models\back\Multibrand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands= Brand::with('category')->with('subcategory')->get();
        return view('back.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('back.brand.create',['categories' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands',
            'slug' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'status' => 'required',
            'image' => 'required|max:2048'
        ]);
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->status = $request->status;
        $brand->category_id = $request->category;

        //image section
        $imageName = $request->image->getClientOriginalName();
        $imageNewName =uniqid().'.'.$request->image->getClientOriginalExtension();
        $imageNew = Str::replace($imageName, $imageNewName, $imageName);
        $request->image->move(public_path('/assets/back/uploads/brand'), $imageNew);
        $brand->image = '/assets/back/uploads/brand/' . $imageNew;
        $brand->save();
        $brandId = $brand->id;
        $subcategories = $request->subcategory;
        if($subcategories != null){
            for($i = 0; $i < count($subcategories); $i++){
                Multibrand::create([
                    "brand_id" => $brandId,
                    'subcategory_id' => $subcategories[$i]
                ]);
            }
        }
        return redirect()->route('brand.index')->with('success','You have successfully added brand details');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $eid)
    {
        $id = Crypt::decryptString($eid);
        $category = Category::all();
        $brand = Brand::find($id);
        return view('back.brand.edit', ['categories' => $category, 'brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $eid)
    {
        $id = Crypt::decryptString($eid);
        $brand = Brand::find($id);
        Brand::destroy($id);
        if(File::exists(public_path($brand->image))){
            File::delete(public_path($brand->image));
        }
        return redirect()->back()->with('success', 'Successfully Deleted');
    }

    public function subcategories(Request $request)
    {
        $catId = $request->post('catId');
        $subcategory = Subcategory::where('category_id',$catId)->get();
        $html = '<option value=""></option>';
        foreach($subcategory as $key => $subcat){
            $html .= '<option value="'.$subcat->id.'">'.$subcat->name.'</option>';
        }
        return  $html;
    }

    public function brandsubcategories(Request $req)
    {
        $brandSubCat = $req->post('cat_Id');
        $brandId = $req->post('brand_Id');
        $subcat = Subcategory::where('category_id',$brandSubCat)->get();
        $html = '<option value=""></option>';
        foreach($subcat as $key => $item){
            $subcatId = Multibrand::where(['brand_id' => $brandId],['subcateory_id' => $item->id])->get();
            $subcatId=json_decode($subcatId, true);
            $html .= '<option value="'.$item->id.'"'. ($item->id == $subcatId['subcategory_id'] ? "selected" : "").'>'.$item->name.'</option>';
        }
        return $html;
    }
}
