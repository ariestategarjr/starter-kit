<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $invoice_code = $this->generateInvoiceCode();

        return view('pages.purchases.index', compact('invoice_code'));
    }

    public function generateInvoiceCode()
    {
        // Mengambil tanggal hari ini
        $date = date('Y-m-d');

        // Menjalankan query untuk mendapatkan nomor faktur terakhir pada tanggal tersebut
        $query = DB::select(
            "SELECT MAX(invoice) AS invoice FROM sales
             WHERE DATE_FORMAT(date, '%Y-%m-%d') = '$date'"
        );

        // Mengambil hasil query
        $result = $query[0];
        $data = $result->invoice;

        // Mengambil empat digit terakhir dari nomor faktur
        $lastOrderNumb = substr($data, -4);
        $nextOrderNumb = intval($lastOrderNumb) + 1;

        // Format kode faktur baru
        $invoice = 'INVP' . date('dmy', strtotime($date)) . sprintf('%04s', $nextOrderNumb);

        // Mengembalikan kode faktur
        return $invoice;
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

    // modal - supplier modal
    public function showSuppliersModal()
    {
        return response()->json(['modal' => true]);
    }

    // modal - supplier data
    public function showSuppliersModalData(Request $request)
    {
        $query = DB::table('suppliers')->select('*');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('suppliers.name', 'like', '%' . $search . '%');
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
}
