<?php

use App\Http\Controllers\back\BrandController;
use App\Http\Controllers\back\CategoryController;
use App\Http\Controllers\back\SubcategoryController;
use App\Models\back\Subcategory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('category',CategoryController::class);
Route::get('trash/category',[CategoryController::class, 'trash'])->name('category.trash');
Route::get('restore/category/{eid}',[CategoryController::class, 'restore'])->name('category.restore');
Route::get('delete/category/{eid}', [CategoryController::class, 'forcedelete'])->name('category.delete');
Route::resource('subcategory', SubcategoryController::class);
Route::get('trash/subcategory',[SubcategoryController::class,'trash'])->name('subcategory.trash');
Route::get('restore/subcategory/{eid}',[SubcategoryController::class,'restore'])->name('subcategory.restore');
Route::get('delete/subcategory/{eid}',[SubcategoryController::class, 'forcedelete'])->name('subcategory.forecedelete');
Route::resource('brand',BrandController::class);
//Route::post('get/brand/{id}',[BrandController::class, 'subcategories']);
Route::post('/subcategories', [BrandController::class,'subcategories']); //AJAX request to get sub categories
Route::post('/brandsubcategories',[BrandController::class, 'brandsubcategories']);


