<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Count Products, Sales, and Purchases
        $dataCountProducts = DB::table('products')->count();
        $dataCountSales = DB::table('sales')->count();
        $dataCountPurchases = DB::table('purchases')->count();

        // Best Seller
        $dataBestSeller = DB::table('sales_detail')
            ->join('products', 'sales_detail.barcode', '=', 'products.barcode')
            ->select('products.name', 'products.selling_price', DB::raw('SUM(amount) AS amount'))
            ->groupBy('sales_detail.barcode', 'products.name', 'products.selling_price')
            ->orderByDesc('amount')
            ->limit(10)
            ->get()
            ->toArray();

        // Empty Stock
        $dataEmptyStock = DB::table('products')
            ->where('stock', 0)
            ->select('name')
            ->get()
            ->toArray();

        $data = [
            'dataCountProducts' => $dataCountProducts,
            'dataCountSales' => $dataCountSales,
            'dataCountPurchases' => $dataCountPurchases,
            'dataBestSeller' => $dataBestSeller,
            'dataEmptyStock' => $dataEmptyStock,
        ];

        return view('pages.dashboard.index', $data);
    }
}
