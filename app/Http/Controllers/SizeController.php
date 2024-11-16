<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $query = Size::query();

        $sizes = $query->paginate(10);
        return view('sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'size_name' => 'required|max:255',
            'description' => 'required'
        ]);

        Size::create($request->all());

        return redirect()->route('sizes.index')
            ->with('success', 'Tamaño creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        return view('sizes.show', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        return view('sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $request->validate([
            'size_name' => 'required|max:255',
            'description' => 'required'
        ]);

        $size->update($request->all());

        return redirect()->route('sizes.index')
            ->with('success', 'Tamaño actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();

        return redirect()->route('sizes.index')
            ->with('success', 'Tamaño eliminado exitosamente.');
    }
}
