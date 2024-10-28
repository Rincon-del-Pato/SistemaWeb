<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Enums\TableSize;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Enums\TableStatusProd;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Validation\Rules\Can;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     $categories = Categories::all();
    //     $products = Products::all();
    //     return view('products.index', compact('products', 'categories'));
    // }

    public function index(Request $request)
    {
        $categories = Categories::all();

        $query = Products::query();

        // Aplicar filtro de búsqueda si existe
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        }

        // Paginar los resultados
        $products = $query->paginate(9);

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $size = TableSize::cases();
        $status = TableStatusProd::cases();
        $product = new Products;
        $category = Categories::all();
        return view('products.create', compact('product', 'status', 'category','size'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate(Products::$rules);

        $imageProduct = $request->file('image')->store('products', 'public');

        Products::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'image_producto' => $imageProduct,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        //
        $status = TableStatusProd::cases();
        $category = Categories::all();
        return view('products.edit', compact('product', 'status', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        //
        request()->validate(Products::$rules);

        if ($request->hasFile('image')) {
            if ($product->image_producto) {
                Storage::disk('public')->delete($product->image_producto);
            }
            $imageProduct = $request->file('image')->store('products', 'public');
            $product->update([
                'image_producto' => $imageProduct,
            ]);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        //
        $product->delete();

        return redirect()->route('products.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $product->status = $request->input('status');
        $product->save();
        return response()->json(['success' => true]);
        // return redirect()->back();
    }
}
