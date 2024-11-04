<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Enums\TableSize;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Enums\TableStatusProd;
use App\Models\Sizes;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Facades\DB;
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

        // Inicializar arrays vacíos para un nuevo producto
        $productTypes = []; // Array vacío para tipos
        $prices = [
            'Unico' => null,
            'Personal' => null,
            'Fuente' => null
        ];
        $statuses = [
            'Unico' => null,
            'Personal' => null,
            'Fuente' => null
        ];

        return view('products.create', compact('product', 'status', 'category', 'size', 'prices', 'statuses', 'productTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // return $request;
        request()->validate(Products::$rules);

        try {
            DB::beginTransaction();

            // Crear el producto base
            $product = new Products();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;

            // Procesar la imagen si se proporcionó una
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/products'), $imageName);
                $product->image_producto = $imageName;
            }

            $product->save();

            // Procesar los tipos seleccionados y sus detalles
            foreach ($request->types as $type) {
                // Solo crear Size si el tipo está seleccionado y tiene un precio
                if (!empty($request->prices[$type])) {
                    $size = new Sizes();
                    $size->type = $type;
                    $size->price = $request->prices[$type];
                    $size->status = $request->statuses[$type]; //- ?? 'Oculto'; // Por defecto Oculto si no se especifica
                    $size->save();

                    // Crear la relación en la tabla pivot
                    $product->sizes()->attach($size->id);
                }
            }

            DB::commit();

            return redirect()->route('products.index')
                ->with('success', 'Producto creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
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

        $productSizes = $product->sizes;

        $productTypes = $productSizes->pluck('type')->toArray();
        $prices = [
            'Unico' => null,
            'Personal' => null,
            'Fuente' => null
        ];
        $statuses = [
            'Unico' => null,
            'Personal' => null,
            'Fuente' => null
        ];

        foreach ($productSizes as $size) {
            $prices[$size->type] = $size->price;
            $statuses[$size->type] = $size->status;
        }

        return view('products.edit', compact('product', 'status', 'category', 'prices', 'statuses', 'productTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        //return $request;
        //request()->validate(Products::$rules);

        try {
            DB::beginTransaction();

            // Actualizar datos básicos del producto
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;

            // Procesar imagen si se subió una nueva
            if ($request->hasFile('image')) {
                // Eliminar imagen anterior si existe
                if ($product->image_producto) {
                    $oldImagePath = public_path('images/products/') . $product->image_producto;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/products'), $imageName);
                $product->image_producto = $imageName;
            }

            $product->save();

            // Eliminar todas las relaciones existentes
            $product->sizes()->detach();

            // Crear nuevos tamaños y relaciones
            foreach ($request->types as $type) {
                if (!empty($request->prices[$type])) {
                    // Crear o encontrar el tamaño
                    $size = Sizes::updateOrCreate(
                        ['type' => $type],
                        [
                            'price' => $request->prices[$type],
                            'status' => $request->statuses[$type] ?? 'Oculto'
                        ]
                    );

                    // Crear la relación en la tabla pivot
                    $product->sizes()->attach($size->id);
                }
            }

            DB::commit();
            return redirect()->route('products.index')
                ->with('success', 'Producto actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        //
        //$product->delete();

        try {
            DB::beginTransaction();

            // Eliminar imagen si existe
            if ($product->image_producto) {
                $oldImagePath = public_path('images/products/') . $product->image_producto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Eliminar todas las relaciones
            $product->sizes()->detach();

            // Eliminar el producto
            $product->delete();

            DB::commit();
            return redirect()->route('products.index')
                ->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }

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
