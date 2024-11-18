<?php

use App\Models\Tables;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\MenuItemSizeController;
use App\Http\Controllers\InventoryItemsController;
use App\Http\Controllers\PermissionsionController;
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

    //Dashboard
    Route::get('/dashboard/sales-data', [DashboardController::class, 'getSalesData']);
    Route::get('/dashboard/inventory-status', [DashboardController::class, 'getInventoryStatus']);
    Route::get('/dashboard/employee-performance', [DashboardController::class, 'getEmployeePerformance']);

    //Personal
    Route::resource('roles', RolController::class)->parameters(['roles' => 'role'])->names('roles');
    Route::resource('permisos', PermissionsionController::class)->names('permisos');
    Route::resource('usuarios', UserController::class)->names('usuarios');
    Route::resource('employees', EmployeesController::class)->names('employees');

    //Sistema
    Route::resource('settings', SettingsController::class)->names('settings');
    Route::resource('tables', TableController::class)->names('tables');

    //Inventario
    Route::resource('units', UnitController::class)->names('units');
    Route::resource('inventory-items', InventoryItemsController::class)->names('inventory-items');
    Route::resource('suppliers', SupplierController::class)->names('suppliers');
    Route::resource('inventory', InventoryItemsController::class)->names('inventory');
    Route::get('/inventory/{id}/history', [InventoryItemsController::class, 'history'])->name('inventory.history');
    Route::get('/inventory/{id}/register-movement', [InventoryItemsController::class, 'registerMovement'])
        ->name('inventory.register-movement');
    Route::post('/inventory/{id}/store-movement', [InventoryItemsController::class, 'storeMovement'])
        ->name('inventory.store-movement');
    Route::get('/inventory/{id}/supply', [InventoryItemsController::class, 'supply'])->name('inventory.supply');
    Route::post('/inventory/{id}/store-supply', [InventoryItemsController::class, 'storeSupply'])->name('inventory.store-supply');

    //Menu
    Route::resource('categories', CategoryController::class)->names('categories');
    Route::resource('size', SizeController::class)->names('size');
    Route::resource('menu', MenuItemController::class)->names('menu');

    Route::resource('customers', CustomerController::class)->names('customers');





});


// Route::resource('products', ProductsController::class)->names('products');
// Route::put('/products/{id}/status', [ProductsController::class, 'updateStatus'])->name('products.updateStatus');

// Route::resource('menus', MenuController::class)->names('menus');

// Route::get('/orders', [OrdersController::class, 'index'])->name('order.index');
// Route::get('/orders/create/{tableId}', [OrdersController::class, 'create'])->name('orders.create');
// Route::post('/orders/table/{tableId}', [OrdersController::class, 'store'])->name('orders.store');


// Route::post('/orders/{order}/items', [OrdersController::class, 'addItems'])->name('orders.addItems');
// Route::post('/orders/{order}/complete', [OrdersController::class, 'completeOrder'])->name('orders.complete');
