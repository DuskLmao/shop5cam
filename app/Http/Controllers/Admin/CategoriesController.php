<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoriesController extends Controller 
{
    public function Categories(){
        $category = Category::all();
        return view( 'admin.frontend.categories',compact('category'));
    }
    public function createCategories(){
        return view('admin.frontend.categories.create');
    }
    public function storeCategories(Request $request){
        $category = new Category;
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->created_at = $request->input('created_at');
        $category->save();
        return redirect()->route('admin.frontend.categories')->with('success', 'Danh mục được thêm thành công');    
    }
    public function editCategories($id){
        $category = Category::find($id);
        // return view('admin.categories', ['category' => $category]);
        return view('admin.frontend.categories', ['category' => $category]);
    }
    public function updateCategories(Request $request, $id){
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        // $category->created_at = $request->input('created_at');
        $category->update();
        return redirect()->route('admin.frontend.categories')->with('success', 'Danh mục được cập nhật thành công');   
    }   
    public function destroyCategories($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.frontend.categories')->with('success', 'Danh mục đã bị xóa');
    }
}