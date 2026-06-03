<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function productCreatePage(){

        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function createProduct(Request $request){
        $this->validateProduct($request);
        $data = $this->requestProductData($request);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('product', $filename, 'public');
            $data['image'] = 'product/' . $filename;
        }

        Product::create($data);
        Alert::success('Product Created', 'New product has been created successfully!');
        return redirect()->route('product#createPage');
    }

    private function validateProduct($request){
        $request->validate([
            'name' => 'required|min:5|unique:products,name',
            'category' => 'required',
            'description' => 'required|min:10',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|numeric',
            'count' => 'required|numeric',
        ]);
    }

    private function requestProductData($request){
        return [
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'count' => $request->count,
        ];
    }

    public function productList(Request $request){

        $products = Product::with('category')
            ->when($request->key, function($query, $key){
                $query->where('name', 'like', '%'.$key.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('admin.product.list', compact('products'));
    }

    public function deleteProduct($id){
        $product = Product::where('id', $id)->first();

        if (!$product) {
            Alert::error('Error', 'Product not found!');
            return back();
        }

        if($product->image){
            Storage::disk('public')->delete($product->image);
        }
        Product::where('id', $id)->delete();
        Alert::success('Product Deleted', 'The product has been deleted successfully!');
        return back();
    }
}
