<?php

namespace App\Http\Controllers;

use App\Models\MenuItemSize;
use Illuminate\Http\Request;

class MenuItemSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $menuItemSizes = MenuItemSize::with(['menuItem', 'size'])->get();
        return view('menu-item-sizes.index', compact('menuItemSizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
