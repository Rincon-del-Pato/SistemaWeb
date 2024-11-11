<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Enums\TableStatus;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $tables = Table::paginate(12);
        return view('tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $statuses = TableStatus::cases();
        $table = Table::all();
        // $table = new Tables;
        return view('tables.create', compact('table', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // return $request;

        request()->validate([
            Table::$rules
        ]);

        $capacities = $request -> capacity;
        $quantities = $request -> quantity;

        foreach ($capacities as $index => $capacity) {
            $quantity = $quantities[$index];
            for ($i = 0; $i < $quantity; $i++) {
                Table::create([
                    'name' => 'Mesa ' . (Table::count() + 1),
                    'capacity' => $capacity,
                    'status' => 'Disponible',
                ]);
            }
        }

        return redirect()->route('tables.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $tables)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        //
        $statuses = TableStatus::cases();
        return view('tables.edit', compact('table', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        //
        $table->update($request->all());
        return redirect()->route('tables.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        //
        $table->delete();
        return redirect()->route('tables.index');

    }
}
