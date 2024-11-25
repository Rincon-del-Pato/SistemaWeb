<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Google\Client as Google_Client;
use Illuminate\Support\Facades\Log;
use Google\Service\Drive\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Google\Service\Drive as Google_Service_Drive;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $employees = Employees::with('user.roles')->get();

        $query = Employee::query();

        // Aplicar filtro de búsqueda si existe
        if ($request->has('search')) {
            $searchTerm = $request->search;

            // Filtro por nombre del empleado, DNI del empleado o nombre del rol
            $query->where(function ($q) use ($searchTerm) {
                $q->where('dni', 'LIKE', "%{$searchTerm}%")   // Búsqueda por DNI del empleado
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', "%{$searchTerm}%")  // Búsqueda por nombre del usuario
                            ->orWhereHas('roles', function ($query) use ($searchTerm) {
                                $query->where('name', 'LIKE', "%{$searchTerm}%")
                                    ->orWhere('description', 'LIKE', "%{$searchTerm}%");
                            });
                    });
            });
        }

        $employees = $query->paginate(10);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('description', 'name');  // Cambiado: usando 'name' como valor
        $employee = new Employee;
        $user = new User;

        return view('employees.create', compact('employee', 'roles', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate(Employee::$rules);

        $imageEmployee = null;
        if ($request->hasFile('profile_photo_path')) {
            $imageEmployee = $request->file('profile_photo_path')->store('employees', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path' => $imageEmployee,
        ]);
        $user->syncRoles($request->rols);

        Employee::create([
            'lastname' => $request->lastname,
            'dni' => $request->dni,
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'user_id' => $user->id,
        ]);

        return redirect()->route('employees.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $user = User::find($employee->user_id);
        $roles = Role::pluck('description', 'name');  // Cambiado: usando 'name' como valor
        return view('employees.edit', compact('employee', 'roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $user = User::find($employee->user_id);

        if ($request->hasFile('profile_photo_path')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $imageEmployee = $request->file('profile_photo_path')->store('employees', 'public');
            $user->profile_photo_path = $imageEmployee;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles($request->rols);

        $employee->update([
            'lastname' => $request->lastname,
            'dni' => $request->dni,
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
        ]);

        $user->save();

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();

        return redirect()->route('employees.index');
    }
}
