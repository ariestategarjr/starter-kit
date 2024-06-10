<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Sale;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        // generate invoice code
        $latestInvoice = Sale::latest()->first();
        $newInvoiceNumber = $latestInvoice ? intval(substr($latestInvoice->invoice_code, -4)) + 1 : 1;
        $invoice_code = 'INV' . date('Ymd') . sprintf('%04d', $newInvoiceNumber);

        return view('pages.sales.index', compact('invoice_code'));
    }

    // modal - product
    public function showProductsModal()
    {
        return response()->json(['modal' => true]);
    }

    // modal - product data
    public function showProductsModalData(Request $request)
    {
        $query = DB::table('products')->select('*')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('units', 'products.unit_id', '=', 'units.id')
            ->select('products.*', 'categories.name as category_name', 'units.name as unit_name');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('products.name', 'like', '%' . $search . '%')
                    ->orWhere('categories.name', 'like', '%' . $search . '%');
            });
        }

        $totalData = $query->count();  // Total data sebelum paginasi
        $totalFiltered = $totalData;   // Default filtered count

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query->offset($start)->limit($length);

        $result = $query->get();

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $result
        ]);
    }

    // partials - detail
    public function showSaleDetailTable(Request $request)
    {
        $invoice_code = $request->input('invoice_code');

        $query = DB::table('sales_detail_temporary')
            ->join(
                'products',
                'sales_detail_temporary.barcode',
                '=',
                'products.barcode'
            )
            ->select(
                'sales_detail_temporary.id as id',
                'sales_detail_temporary.barcode as barcode',
                'products.name',
                'sales_detail_temporary.selling_price as selling_price',
                'sales_detail_temporary.amount as amount',
                'sales_detail_temporary.sub_total as sub_total'
            )
            ->where('sales_detail_temporary.invoice', $invoice_code)
            ->orderBy('sales_detail_temporary.id', 'asc');

        $result = $query->get();

        return response()->json([
            'data' => view('pages.sales.partials.detail', compact('result'))->render()
        ]);
    }


    public function storeSaleDetailTemporary(Request $request)
    {
        $invoice_code = $request->invoice_code;
        $barcode = $request->barcode;
        $product_name = $request->product_name;
        $amount = $request->amount;


        if (strlen($product_name) > 0) {
            $query = DB::table('products')
                ->where('barcode', $barcode)
                ->where('name', $product_name);
        } else {
            $query = DB::table('products')
                ->where('barcode', 'like', '%' . $barcode . '%')
                ->orWhere('name', 'like', '%' . $product_name . '%');
        }
        $result = $query->get()->count();

        if ($result == 1) {
            $row = $query->first();

            if (intval($row->stock) == 0) {
                $message = [
                    'error' => 'Maaf, stok produk ini sudah habis.'
                ];
            } else if (intval($row->stock) < $amount) {
                $message = [
                    'error' => 'Maaf, stok tidak mencukupi.'
                ];
            } else {
                $data = [
                    'invoice' => $invoice_code,
                    'barcode' => $barcode,
                    'purchase_price' => $row->purchase_price,
                    'selling_price' => $row->selling_price,
                    'amount' => $amount,
                    'sub_total' => floatval($row->selling_price) * $amount,
                ];

                DB::table('sales_detail_temporary')->insert($data);

                $message = [
                    'success' => 'Data berhasil disimpan.'
                ];
            }
        } else {
            $message = [
                'error' => 'Data tidak ditemukan.'
            ];
        }

        return response()->json($message);
    }
}
