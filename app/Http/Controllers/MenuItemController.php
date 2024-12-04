<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Size;
use App\Models\InventoryItem;
use App\Models\MenuItem;
use App\Enums\ItemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $menuItems = MenuItem::with([
            'category',
            'sizes.unit',
            'inventoryItems.unit'
        ])->get();

        // Agrupar los productos por categoría
        $productsByCategory = [];
        foreach ($categories as $category) {
            $productsByCategory[$category->id] = $menuItems->where('category_id', $category->id)->values();
        }

        return view('menu.index', [
            'categories' => $categories,
            'products' => $productsByCategory
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create', [
            'categories' => Category::all(),
            'sizes' => Size::with('unit')->get(),
            'inventoryItems' => InventoryItem::with('unit')->get(),
            'ingredientItems' => InventoryItem::where('item_type', 'Ingrediente')->with('unit')->get(),
            'prepackagedItems' => InventoryItem::where('item_type', 'Preenvasado')->with('unit')->get(),
            'menuItem' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validación básica común
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'description' => 'required|string',
                'sizes' => 'required|array|min:1',
                'sizes.*.size_id' => 'required|exists:sizes,id',
                'sizes.*.price' => 'required|numeric|min:0',
            ]);

            // Validar según el tipo de producto
            if ($request->product_type === ItemType::Ingrediente->value) {
                $request->validate([
                    'inventory_items' => 'required|array|min:1',
                    'inventory_items.*.inventory_item_id' => 'required|exists:inventory_items,id',
                    'inventory_items.*.quantity_needed' => 'required|numeric|min:0',
                ]);
            } else {
                $request->validate([
                    'prepackaged_item_id' => 'required|exists:inventory_items,id',
                ]);
            }

            DB::transaction(function () use ($request) {
                // Crear el ítem del menú
                $menuItem = MenuItem::create([
                    'name' => $request->name,
                    'category_id' => $request->category_id,
                    'description' => $request->description,
                    'available' => $request->has('available'),
                ]);

                // Guardar tamaños y precios
                foreach ($request->sizes as $size) {
                    $menuItem->sizes()->attach($size['size_id'], [
                        'price' => $size['price']
                    ]);
                }

                // Guardar relación con inventory_items
                if ($request->product_type === ItemType::Ingrediente->value) {
                    // Para productos a preparar, guardar todos los ingredientes
                    foreach ($request->inventory_items as $item) {
                        $menuItem->inventoryItems()->attach($item['inventory_item_id'], [
                            'quantity_needed_per_unit' => $item['quantity_needed']
                        ]);
                    }
                } else {
                    // Para productos preenvasados, guardar el item preenvasado
                    $menuItem->inventoryItems()->attach($request->prepackaged_item_id, [
                        'quantity_needed_per_unit' => 1
                    ]);
                }
            });

            return redirect()->route('menu.index')
                ->with('success', 'Producto creado exitosamente.');

        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Error al crear el producto: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menuItem = MenuItem::with(['category', 'sizes.unit', 'inventoryItems.unit'])->findOrFail($id);

        // Determinar el tipo de producto basado en los inventory_items
        $productType = '';
        if ($menuItem->inventoryItems->count() > 0) {
            $firstItem = $menuItem->inventoryItems->first();
            $productType = $firstItem->item_type;
        }

        // Agregar el tipo de producto al menuItem
        $menuItem->product_type = $productType;

        return view('menu.edit', [
            'menuItem' => $menuItem,
            'categories' => Category::all(),
            'sizes' => Size::with('unit')->get(),
            'inventoryItems' => InventoryItem::with('unit')->get(),
            'ingredientItems' => InventoryItem::where('item_type', 'Ingrediente')->with('unit')->get(),
            'prepackagedItems' => InventoryItem::where('item_type', 'Preenvasado')->with('unit')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Similar validation and logic as store() but with update operations
        # ...implement update logic...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
