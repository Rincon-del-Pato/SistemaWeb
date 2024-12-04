<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\MenuItemSize;
use App\Models\Size;
use Illuminate\Http\Request;

class MenuItemSizeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = MenuItem::with(['category', 'sizes'])->get();
        
        return view('menu.index', compact('categories', 'products'));
    }

    public function create()
    {
        $menuItem = new MenuItem();
        $categories = Category::all();
        $sizes = Size::all();
        
        return view('menu.create', compact('menuItem', 'categories', 'sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'size_id' => 'required|exists:sizes,id',
            'price' => 'required|numeric|min:0'
        ]);

        MenuItemSize::create($request->all());

        return redirect()->route('menu-item-sizes.index')
            ->with('success', 'Precio y tamaño agregado correctamente');
    }

    public function edit(MenuItemSize $menuItemSize)
    {
        $categories = Category::all();
        $sizes = Size::all();
        
        return view('menu.edit', compact('menuItemSize', 'categories', 'sizes'));
    }

    public function update(Request $request, MenuItemSize $menuItemSize)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'size_id' => 'required|exists:sizes,id',
            'price' => 'required|numeric|min:0'
        ]);

        $menuItemSize->update($request->all());

        return redirect()->route('menu.index')
            ->with('success', 'Precio y tamaño actualizado correctamente');
    }

    public function destroy(MenuItemSize $menuItemSize)
    {
        $menuItemSize->delete();

        return redirect()->route('menu-item-sizes.index')
            ->with('success', 'Precio y tamaño eliminado correctamente');
    }

    // Método adicional para actualización masiva
    public function bulkUpdate(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'sizes' => 'required|array',
            'sizes.*.size_id' => 'required|exists:sizes,id',
            'sizes.*.price' => 'required|numeric|min:0'
        ]);

        // Eliminar tamaños existentes
        MenuItemSize::where('menu_item_id', $menuItem->id)->delete();

        // Crear nuevos registros
        foreach ($request->sizes as $size) {
            MenuItemSize::create([
                'menu_item_id' => $menuItem->id,
                'size_id' => $size['size_id'],
                'price' => $size['price']
            ]);
        }

        return back()->with('success', 'Precios actualizados correctamente');
    }
}
