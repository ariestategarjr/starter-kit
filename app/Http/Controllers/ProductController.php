<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Unit;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    // function generateBarcode()
    // {
    //     $timestamp = time();
    //     $randomString = substr($timestamp, 0, 20);
    //     return $randomString;
    // }

    public function index()
    {
        // $products = Product::with('category')->get();
        $products = Product::all();

        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        // $products = Product::with(['category', 'unit'])->get();
        $categories = Category::all();
        $units = Unit::all();
        return view('pages.products.create', compact('categories', 'units'));
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

        // create product
        Product::create([
            'barcode' => $request->barcode,
            'name' => $request->name,
            'unit_id' => $request->unit,
            'category_id' => $request->category,
            'stock' => $request->stock,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
        ]);

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id)
    {
        $product = Product::with(['category', 'unit'])->findOrFail($id);
        $units = Unit::all();
        $categories = Category::all();

        // dd($product->unit->name);
        return view('pages.products.edit', compact('product', 'units', 'categories'));
    }

    // public function update(Request $request, $id): RedirectResponse
    // {
    //     //validate form
    //     $request->validate([
    //         'name'         => 'required',
    //     ]);

    //     $category = Category::findOrFail($id);

    //     //create category
    //     $category->update([
    //         'name' => $request->name,
    //     ]);

    //     return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Diubah!']);
    // }

    public function update(Request $request, $id)
    {
        // dd($id);
        // //validate form
        $request->validate([
            'barcode' => 'required',
            'name' => 'required',
            'unit' => 'required',
            'category' => 'required',
            'stock' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'barcode' => $request->barcode,
            'name' => $request->name,
            'unit_id' => $request->unit,
            'category_id' => $request->category,
            'stock' => $request->stock,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
        ]);

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
