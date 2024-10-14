<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = User::query();

        // if ($request->has('search')) {
        //     $searchTerm = $request->search;
        //     $query->where('name', 'LIKE', "%{$searchTerm}%")
        //         ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        // }

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('roles', function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', "%{$searchTerm}%")
                                ->orWhere('description', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }


        $usuarios = $query->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $usuario = new User;
        $roles = Role::pluck('description', 'name');
        return view('usuarios.create', compact('usuario', 'roles'));
    }

    public function store(Request $request)
    {
        request()->validate(User::$rules);

        // $usuario = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //     ]);

        // $usuario->syncRoles($request->rols);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->syncRoles($request->rols);




        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        //
        return view('profile.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        //

        $roles = Role::pluck('description', 'name');

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        //
        request()->validate(User::$rules);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $usuario->syncRoles($request->rols);

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //
        $usuario->delete();

        return redirect()->route('usuarios.index');
    }
}
