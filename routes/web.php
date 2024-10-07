<?php

use App\Models\Tables;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PermissionsionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
        Route::get('/', function () {
            return view('dashboard');
        });
    })->name('dashboard');
    Route::resource('roles', RolController::class)->parameters(['roles' => 'role'])->names('roles');
    Route::resource('permisos', PermissionsionController::class)->names('permisos');
    Route::resource('usuarios', UserController::class)->names('usuarios');
});

Route::resource('employees', EmployeesController::class)->names('employees');
Route::resource('settings', SettingsController::class)->names('settings');
Route::resource('tables', TablesController::class)->names('tables');
Route::resource('categories', CategoriesController::class)->names('categories');
