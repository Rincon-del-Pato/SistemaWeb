<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Enums\TableStatus;  // Asegúrate de que esta línea esté presente
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::paginate(10);
        return view('tables.index', compact('tables'));
    }

    public function create()
    {
        $statuses = TableStatus::cases();
        $existingTables = Table::all(); // Obtener todas las mesas existentes
        return view('tables.create', compact('statuses', 'existingTables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|string|max:10|unique:tables',
            'seating_capacity' => 'required|integer|min:1',
            'status' => 'required|string|in:' . implode(',', array_column(TableStatus::cases(), 'value'))
        ]);

        // Verificar si ya existe una mesa con el mismo número
        if (Table::where('table_number', $request->table_number)->exists()) {
            return back()->with('error', 'Ya existe una mesa con este número')->withInput();
        }

        Table::create($request->all());
        return redirect()->route('tables.index')->with('success', 'Mesa creada exitosamente');
    }

    public function show(Table $table)
    {
        return view('tables.show', compact('table'));
    }

    public function edit(Table $table)
    {
        $statuses = TableStatus::cases();
        $existingTables = Table::all();
        return view('tables.edit', compact('table', 'statuses', 'existingTables'));
    }

    public function update(Request $request, Table $table)
    {
        $request->validate([
            'table_number' => 'required|string|max:10|unique:tables,table_number,' . $table->id,
            'seating_capacity' => 'required|integer|min:1',
            'status' => 'required|string|in:' . implode(',', array_column(TableStatus::cases(), 'value'))
        ]);

        $table->update($request->all());

        return redirect()->route('tables.index')
            ->with('success', 'Mesa actualizada exitosamente');
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route('tables.index')
            ->with('success', 'Mesa eliminada exitosamente');
    }
}
