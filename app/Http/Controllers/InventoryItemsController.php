<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\InventoryLog;
use App\Enums\ChangeType;

class InventoryItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventoryItems = InventoryItem::with('unit', 'supplier')
            ->orderBy('name')
            ->paginate(10);

        return view('inventory-items.index', compact('inventoryItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $units = Unit::all();
        return view('inventory-items.create', compact('suppliers', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'item_type' => 'required',
            'quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit_id' => 'required|exists:units,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        $item = InventoryItem::create($validated);

        // Registrar en el historial con el nuevo valor del enum
        InventoryLog::create([
            'inventory_item_id' => $item->id,
            'change_type' => ChangeType::Creado->value,
            'quantity_change' => $validated['quantity'],
            'notes' => 'Creación inicial del artículo'
        ]);

        return redirect()->route('inventory.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inventoryItem = InventoryItem::findOrFail($id);
        $suppliers = Supplier::all();
        $units = Unit::all();
        return view('inventory-items.edit', compact('inventoryItem', 'suppliers', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = InventoryItem::findOrFail($id);
        $oldQuantity = $item->quantity;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'item_type' => 'required',
            'quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit_id' => 'required|exists:units,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        $item->update($validated);

        // Registrar cambio en el historial si la cantidad cambió
        if ($oldQuantity != $validated['quantity']) {
            $change = $validated['quantity'] - $oldQuantity;
            InventoryLog::create([
                'inventory_item_id' => $id,
                'change_type' => $change > 0 ? ChangeType::Adición->value : ChangeType::Disminuir->value,
                'quantity_change' => abs($change),
                'notes' => 'Actualización de cantidad'
            ]);
        }

        return redirect()->route('inventory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function history($id)
    {
        $item = InventoryItem::findOrFail($id);
        $logs = InventoryLog::where('inventory_item_id', $id)
                           ->orderBy('change_date', 'desc')
                           ->paginate(10);

        return view('inventory-items.history', compact('item', 'logs'));
    }

    public function registerMovement($id)
    {
        $item = InventoryItem::findOrFail($id);
        return view('inventory-items.register-movement', compact('item'));
    }

    public function storeMovement(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);
        
        $validated = $request->validate([
            'quantity_change' => 'required|integer|not_in:0',
            'notes' => 'required|string'
        ]);

        $newQuantity = $item->quantity + $validated['quantity_change'];
        
        if ($newQuantity < 0) {
            return back()->withErrors(['quantity_change' => 'No hay suficiente stock']);
        }

        // Actualizar cantidad
        $item->update(['quantity' => $newQuantity]);

        // Registrar movimiento
        InventoryLog::create([
            'inventory_item_id' => $id,
            'change_type' => $validated['quantity_change'] > 0 ? ChangeType::Adición->value : ChangeType::Disminuir->value,
            'quantity_change' => abs($validated['quantity_change']),
            'notes' => $validated['notes']
        ]);

        return redirect()->route('inventory.index')
            ->with('success', 'Movimiento registrado correctamente');
    }

    public function supply($id)
    {
        $item = InventoryItem::findOrFail($id);
        return view('inventory-items.supply', compact('item'));
    }

    public function storeSupply(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);
        
        $validated = $request->validate([
            'quantity_change' => 'required|integer|min:1',
            'notes' => 'required|string'
        ]);

        $newQuantity = $item->quantity + $validated['quantity_change'];
        
        // Actualizar cantidad
        $item->update(['quantity' => $newQuantity]);

        // Registrar abastecimiento
        InventoryLog::create([
            'inventory_item_id' => $id,
            'change_type' => ChangeType::Adición->value,
            'quantity_change' => $validated['quantity_change'],
            'notes' => $validated['notes']
        ]);

        return redirect()->route('inventory.index')
            ->with('success', 'Abastecimiento registrado correctamente');
    }

    // El consumo se manejará automáticamente desde el módulo de recetas
    // cuando se prepare un plato, se reducirá automáticamente el inventario
}
