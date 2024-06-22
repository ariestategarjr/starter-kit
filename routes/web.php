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
use App\Http\Controllers\SaleReportController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReportController;

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

    // Suppliers
    Route::prefix('supplier')->group(function () {
        Route::get('/list', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::get('/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    });

    // Sale
    Route::prefix('sale')->group(function () {
        // Route::get('/create', [SaleController::class, 'create'])->name('sale.create');
        // Route::post('/store', [SaleController::class, 'store'])->name('sale.store');
        // Route::get('/edit/{id}', [SaleController::class, 'edit'])->name('sale.edit');
        // Route::post('/update/{id}', [SaleController::class, 'update'])->name('sale.update');
        // Route::get('/destroy/{id}', [SaleController::class, 'destroy'])->name('sale.destroy');
        Route::get('/list', [SaleController::class, 'index'])->name('sales.index');
        Route::get('/showProductsModal', [SaleController::class, 'showProductsModal'])->name('sale.showProductsModal');
        Route::post('/showProductsModalData', [SaleController::class, 'showProductsModalData'])->name('sale.showProductsModalData');
        Route::get('/showCustomersModal', [SaleController::class, 'showCustomersModal'])->name('sale.showCustomersModal');
        Route::post('/showCustomersModalData', [SaleController::class, 'showCustomersModalData'])->name('sale.showCustomersModalData');
        Route::post('/showSaleDetailTable', [SaleController::class, 'showSaleDetailTable'])->name('sale.showSaleDetailTable');
        Route::post('/storeSaleDetailTemporary', [SaleController::class, 'storeSaleDetailTemporary'])->name('sale.storeSaleDetailTemporary');
        Route::post('/deleteSaleDetailTemporaryItem', [SaleController::class, 'deleteSaleDetailTemporaryItem'])->name('sale.deleteSaleDetailTemporaryItem');
        Route::post('/deleteSaleDetailTemporary', [SaleController::class, 'deleteSaleDetailTemporary'])->name('sale.deleteSaleDetailTemporary');
        Route::post('/sumSubTotalToTotal', [SaleController::class, 'sumSubTotalToTotal'])->name('sale.sumSubTotalToTotal');
        Route::post('/showSaleModal', [SaleController::class, 'showSaleModal'])->name('sale.showSaleModal');
        Route::post('/storeSale', [SaleController::class, 'storeSale'])->name('sale.storeSale');
    });

    // Sale Report
    Route::prefix('sale_report')->group(function () {
        Route::get('/list', [SaleReportController::class, 'index'])->name('sales_report.index');
        // Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
        // Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
        // Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        // Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        // Route::get('/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    });

    // Purchase
    Route::prefix('purchase')->group(function () {
        // Route::get('/list', [PurchaseController::class, 'index'])->name('purchases.index');
        // Route::get('/create', [PurchaseController::class, 'create'])->name('purchase.create');
        // Route::post('/store', [PurchaseController::class, 'store'])->name('purchase.store');
        // Route::get('/edit/{id}', [PurchaseController::class, 'edit'])->name('purchase.edit');
        // Route::post('/update/{id}', [PurchaseController::class, 'update'])->name('purchase.update');
        // Route::get('/destroy/{id}', [PurchaseController::class, 'destroy'])->name('purchase.destroy');
        Route::get('/list', [PurchaseController::class, 'index'])->name('purchases.index');
        Route::get('/showProductsModal', [PurchaseController::class, 'showProductsModal'])->name('purchase.showProductsModal');
        Route::post('/showProductsModalData', [PurchaseController::class, 'showProductsModalData'])->name('purchase.showProductsModalData');
        Route::get('/showSuppliersModal', [PurchaseController::class, 'showSuppliersModal'])->name('purchase.showSuppliersModal');
        Route::post('/showSuppliersModalData', [PurchaseController::class, 'showSuppliersModalData'])->name('purchase.showSuppliersModalData');
        Route::post('/showSaleDetailTable', [PurchaseController::class, 'showPurchaseDetailTable'])->name('purchase.showPurchaseDetailTable');
        Route::post('/storeSaleDetailTemporary', [PurchaseController::class, 'storePurchaseDetailTemporary'])->name('purchase.storePurchaseDetailTemporary');
        Route::post('/deleteSaleDetailTemporaryItem', [PurchaseController::class, 'deletePurchaseDetailTemporaryItem'])->name('purchase.deletePurchaseDetailTemporaryItem');
        Route::post('/deleteSaleDetailTemporary', [PurchaseController::class, 'deletePurchaseDetailTemporary'])->name('purchase.deletePurchaseDetailTemporary');
        Route::post('/sumSubTotalToTotal', [PurchaseController::class, 'sumSubTotalToTotal'])->name('purchase.sumSubTotalToTotal');
        Route::post('/showPurchaseModal', [PurchaseController::class, 'showPurchaseModal'])->name('purchase.showPurchaseModal');
        Route::post('/storePurchase', [PurchaseController::class, 'storeSale'])->name('purchase.storePurchase');
    });

    // Purchase Report
    Route::prefix('purchase_report')->group(function () {
        Route::get('/list', [PurchaseReportController::class, 'index'])->name('purchases_report.index');
        // Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
        // Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
        // Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        // Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        // Route::get('/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    });
});

require __DIR__ . '/auth.php';
