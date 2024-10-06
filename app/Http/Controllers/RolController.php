<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $role = new Role();
        $permissions = Permission::all();
        return view('roles.create', compact('role','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Role::create([
        'name' => $request->name,
        'description' => $request->description,
        'tipo'=>'cargo']);
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
        return view('roles.show', compact('role'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //

        $permissions = Permission::all();

        return view('roles.edit', compact('role','permissions'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'tipo'=>'cargo']);

        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Rol actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index');
    }

}
