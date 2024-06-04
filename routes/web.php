<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Session\ErrorController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;

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


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', function () {
//     return view('dashboard.index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::fallback([ErrorController::class, 'notFound']);

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users
    Route::prefix('user')->group(function () {
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/list', [UserController::class, 'index'])->name('users.index');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    // Categories
    Route::prefix('category')->group(function () {
        Route::get('/list', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    // Units
    Route::prefix('unit')->group(function () {
        Route::get('/list', [UnitController::class, 'index'])->name('units.index');
        Route::get('/create', [UnitController::class, 'create'])->name('unit.create');
        Route::post('/store', [UnitController::class, 'store'])->name('unit.store');
        Route::get('/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
        Route::post('/update/{id}', [UnitController::class, 'update'])->name('unit.update');
        Route::get('/destroy/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');
    });

    // Products
    Route::prefix('product')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    // Customers
    Route::prefix('customer')->group(function () {
        Route::get('/list', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::get('/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    });

    // Supplier
    Route::prefix('supplier')->group(function () {
        Route::get('/list', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
        Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::get('/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    });

    // Sale
    Route::prefix('sale')->group(function () {
        Route::get('/list', [SaleController::class, 'index'])->name('sales.index');
        // Route::get('/create', [SaleController::class, 'create'])->name('sale.create');
        Route::post('/store', [SaleController::class, 'store'])->name('sale.store');
        // Route::get('/edit/{id}', [SaleController::class, 'edit'])->name('sale.edit');
        // Route::post('/update/{id}', [SaleController::class, 'update'])->name('sale.update');
        // Route::get('/destroy/{id}', [SaleController::class, 'destroy'])->name('sale.destroy');
        Route::get('/showProductsModal', [SaleController::class, 'showProductsModal'])->name('sale.showProductsModal');
        Route::get('/displayProductsData', [SaleController::class, 'displayProductsData'])->name('sale.displayProductsData');
    });

    // Purchase
    Route::prefix('purchase')->group(function () {
        Route::get('/list', [PurchaseController::class, 'index'])->name('purchases.index');
        Route::get('/create', [PurchaseController::class, 'create'])->name('purchase.create');
        Route::post('/store', [PurchaseController::class, 'store'])->name('purchase.store');
        Route::get('/edit/{id}', [PurchaseController::class, 'edit'])->name('purchase.edit');
        Route::post('/update/{id}', [PurchaseController::class, 'update'])->name('purchase.update');
        Route::get('/destroy/{id}', [PurchaseController::class, 'destroy'])->name('purchase.destroy');
    });
});

require __DIR__ . '/auth.php';
