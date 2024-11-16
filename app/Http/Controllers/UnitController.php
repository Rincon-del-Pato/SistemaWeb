<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_name' => 'required|max:50',
            'abbreviation' => 'required|max:10',
            'description' => 'nullable|max:255'
        ]);

        Unit::create($request->all());

        return redirect()->route('units.index')
            ->with('success', 'Unidad creada exitosamente.');
    }

    public function edit($id)
    {
        $unit = Unit::find($id);
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_name' => 'required|max:50',
            'abbreviation' => 'required|max:10',
            'description' => 'nullable|max:255'
        ]);

        $unit = Unit::find($id);
        $unit->update($request->all());

        return redirect()->route('units.index')
            ->with('success', 'Unidad actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();

        return redirect()->route('units.index')
            ->with('success', 'Unidad eliminada exitosamente.');
    }
}
