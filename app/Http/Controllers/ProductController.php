<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(StoreProductRequest $request)
    {
        DB::transaction(function() use($request){
            $validated = $request->validated();

            if($request->hasFile('thumbnail')){
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            Product::create($validated);
        });
        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        DB::transaction(function() use($request, $product) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'tagline' => 'required|string|max:255',
                'about' => 'required|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if($request->hasFile('thumbnail')) {
                if($product->thumbnail) {
                    Storage::delete('public/' . $product->thumbnail);
                }
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            } else {
                $validated['thumbnail'] = $product->thumbnail;
            }

            $product->update($validated);
        });

        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        DB::transaction(function() use ($product){
            $product->delete();
        });
        return redirect()->route('admin.products.index');
    }
}