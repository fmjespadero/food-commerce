<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $products = Product::select(['name', 'description', 'stock_quantity', 'category_id', 'price', 'id'])
            ->with('category'); // Ensure you include relationships if necessary
    
            return DataTables::of($products)
                ->addColumn('image', function ($product) {
                    $imageUrl = $product->getFirstMediaUrl();
                    return $imageUrl ? view('components.dt-image', compact('imageUrl')) : 'No Image';
                })
                ->addColumn('category', function ($product) {
                    return $product->category ? $product->category->name : 'N/A';
                })
                ->addColumn('action', function ($product) {
                    return view('components.dt-action-buttons', [
                        'model' => $product,
                        'routePrefix' => 'products'
                    ])->render();
                })
                ->rawColumns(['image', 'action', 'category'])
                ->make(true);
        }
    
        return view('dashboard.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();
       
        $product = Product::create($validatedData);
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uniqueFileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        
            $product->addMedia($image)
                    ->usingFileName($uniqueFileName)
                    ->toMediaCollection();
        }
        
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $imageCount = $product->getMedia()->count();
        return view('dashboard.product.edit', compact('product', 'categories', 'imageCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        $product->update($validatedData);

        if ($request->hasFile('image')) {
            if ($product->hasMedia()) {
                $product->clearMediaCollection();
            }
            
            $image = $request->file('image');
            $uniqueFileName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            
            $product->addMedia($image)
                    ->usingFileName($uniqueFileName)
                    ->toMediaCollection();
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}