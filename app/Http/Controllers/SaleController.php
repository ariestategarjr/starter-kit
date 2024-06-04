<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('pages.sales.index', compact('customers'));
    }

    public function store(Request $request)
    {
        // validate form
        $request->validate([
            'barcode' => 'required',
            'name' => 'required',
            'unit' => 'required',
            'category' => 'required',
            'stock' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
        ]);
    }

    public function showSaleDetailTable()
    {
    }

    public function showProductsModal()
    {
        // $message = [
        //     'modal' => view('pages.sales.modal.product')
        // ];

        // return response()->json($message);
        return response()->json(['modal' => true]);
    }

    public function displayProductsData()
    {
        $products = Product::all();

        return response()->json(['data' => $products]);
    }
}
