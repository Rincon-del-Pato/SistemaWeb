<?php

use App\Models\Tables;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MenuItemSizeController;
use App\Http\Controllers\InventoryItemsController;
use App\Http\Controllers\PermissionsionController;
use App\Http\Controllers\SupplierProductController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::get('/', function () {
    return redirect()->route('login'); // Redirige a la página de login
});

// Rutas de autenticación
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas adicionales para obtener datos específicos del dashboard
    Route::get('/dashboard/sales-data', [DashboardController::class, 'getSalesData']);
    Route::get('/dashboard/inventory-status', [DashboardController::class, 'getInventoryStatus']);
    Route::get('/dashboard/employee-performance', [DashboardController::class, 'getEmployeePerformance']);

    Route::resource('roles', RolController::class)->parameters(['roles' => 'role'])->names('roles');
    Route::resource('permisos', PermissionsionController::class)->names('permisos');
    Route::resource('usuarios', UserController::class)->names('usuarios');

    Route::resource('settings', SettingsController::class)->names('settings');

    Route::resource('employees', EmployeesController::class)->names('employees');

    Route::resource('categories', CategoryController::class)->names('categories');

    Route::resource('menu-items', MenuItemController::class)->names('menu-items');
    Route::resource('size', SizeController::class)->names('size');
    Route::resource('menu-item-sizes', MenuItemSizeController::class)->names('menu-item-sizes');
    Route::resource('customers', CustomerController::class)->names('customers');
    Route::resource('suppliers', SupplierController::class)->names('suppliers');
    Route::resource('inventory', InventoryController::class)->names('inventory');
    Route::resource('tables', TableController::class)->names('tables');
    Route::resource('units', UnitController::class)->names('units');
    Route::resource('inventory', InventoryItemsController::class)->names('inventory');
    Route::resource('menu_items', MenuItemController::class)->names('menu-items');
});


// Route::resource('products', ProductsController::class)->names('products');
// Route::put('/products/{id}/status', [ProductsController::class, 'updateStatus'])->name('products.updateStatus');

// Route::resource('menus', MenuController::class)->names('menus');

// Route::get('/orders', [OrdersController::class, 'index'])->name('order.index');
// Route::get('/orders/create/{tableId}', [OrdersController::class, 'create'])->name('orders.create');
// Route::post('/orders/table/{tableId}', [OrdersController::class, 'store'])->name('orders.store');


// Route::post('/orders/{order}/items', [OrdersController::class, 'addItems'])->name('orders.addItems');
// Route::post('/orders/{order}/complete', [OrdersController::class, 'completeOrder'])->name('orders.complete');
