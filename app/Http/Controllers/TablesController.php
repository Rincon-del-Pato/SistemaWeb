<?php

namespace App\Http\Controllers;

use App\Models\tables;
use App\Enums\TableStatusTab;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $tables = Tables::paginate(12);
        return view('tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $statuses = TableStatusTab::cases();
        $table = Tables::all();
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
            Tables::$rules
        ]);

        $capacities = $request -> capacity;
        $quantities = $request -> quantity;

        foreach ($capacities as $index => $capacity) {
            $quantity = $quantities[$index];
            for ($i = 0; $i < $quantity; $i++) {
                Tables::create([
                    'name' => 'Mesa ' . (Tables::count() + 1),
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
    public function show(tables $tables)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tables $table)
    {
        //
        $statuses = TableStatusTab::cases();
        return view('tables.edit', compact('table', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tables $table)
    {
        //
        $table->update($request->all());
        return redirect()->route('tables.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tables $table)
    {
        //
        $table->delete();
        return redirect()->route('tables.index');

    }
}
