<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function categoryList(Request $request){
        $categories = Category::when($request->key, function($query, $key){
            $query->where('name', 'like', '%'.$key.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        
        return view('admin.category.list', compact('categories'));
    }

    public function createCategory(Request $request){
        $request->validate([
            'categoryName' => 'required',
        ],
        [
            'categoryName.required' => 'Category name is required',
        ]);

        Category::create([
            'name' => $request->categoryName,
        ]);
        Alert::success('Category Created', 'New category has been created successfully!');
        return back();
    }

    public function deleteCategory($id){
        Category::findorFail($id)->delete();
        Alert::success('Category Deleted', 'The category has been deleted successfully!');
        return back();
    }

    public function editCategory($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function updateCategory(Request $request){
        $request->validate([
            'categoryName' => 'required|unique:categories,name,'.$request->categoryId,
        ],
        [
            'categoryName.required' => 'Category name is required',
            'categoryName.unique' => 'Category name already exists',
        ]);

        Category::where('id', $request->categoryId)->update([
            'name' => $request->categoryName,
        ]);

        Alert::success('Category Updated', 'The category has been updated successfully!');
        return redirect()->route('category#list');
    }

    
}

