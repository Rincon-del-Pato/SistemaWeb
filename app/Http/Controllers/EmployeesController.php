<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employees;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $employees = Employees::with('user.roles')->get();
        $employees = Employees::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::pluck('description', 'name');
        $employee = new Employees;
        $user = new User;

        return view('employees.create', compact('employee', 'roles','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // return $request;

        request()->validate(Employees::$rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->rols);

        Employees::create([
            'user_id' => $user->id,
            'lastname' => $request->lastname,
            'dni' => $request->dni,
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employee)
    {
        //

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employees $employee)
    {
        //
        $user = User::find($employee->user_id);
        $roles = Role::pluck('description', 'name');

        return view('employees.edit', compact('employee', 'roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employees $employee)
    {
        //
        $employee->update([
            'lastname' => $request->lastname,
            'dni' => $request->dni,
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        $user = User::find($employee->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles($request->rols);

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employees $employee)
    {
        //
        $employee->delete();

        return redirect()->route('employees.index');

    }
}
