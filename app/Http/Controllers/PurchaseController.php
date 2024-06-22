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

    public function sumSubTotalToTotal(Request $request)
    {
        // Ambil nilai fakturcode dari request
        $invoice_code = $request->invoice_code;

        // Query database untuk mendapatkan totalbayar
        $result = DB::table('purchases_detail_temporary')
            ->select(DB::raw('SUM(sub_total) as total'))
            ->where('invoice', $invoice_code)
            ->first();

        // Format totalbayar
        $total = number_format($result->total, 0, ",", ".");

        // Buat response JSON
        $message = [
            'data' => $total
        ];

        return response()->json($message);
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

    // partials - detail
    public function showPurchaseDetailTable(Request $request)
    {
        $invoice_code = $request->input('invoice_code');

        $query = DB::table('purchases_detail_temporary')
            ->join(
                'products',
                'purchases_detail_temporary.barcode',
                '=',
                'products.barcode'
            )
            ->select(
                'purchases_detail_temporary.id as id',
                'purchases_detail_temporary.barcode as barcode',
                'products.name',
                'purchases_detail_temporary.selling_price as selling_price',
                'purchases_detail_temporary.amount as amount',
                'purchases_detail_temporary.sub_total as sub_total'
            )
            ->where('purchases_detail_temporary.invoice', $invoice_code)
            ->orderBy('purchases_detail_temporary.id', 'asc');

        $result = $query->get();

        // dd($result);

        return response()->json([
            'data' => view('pages.purchases.partials.detail', compact('result'))->render()
        ]);
        // return response()->json([
        //     'data' => $result ? "OK Kueri AMMAN" : "!!!!"
        // ]);
    }

    // purchase detail operations
    public function storePurchaseDetailTemporary(Request $request)
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

            $data = [
                'invoice' => $invoice_code,
                'barcode' => $barcode,
                'purchase_price' => $row->purchase_price,
                'selling_price' => $row->selling_price,
                'amount' => $amount,
                'sub_total' => floatval($row->selling_price) * $amount,
            ];

            DB::table('purchases_detail_temporary')->insert($data);

            // Kurangi stok produk
            DB::table('products')
                ->where('barcode', $barcode)
                ->increment('stock', $amount);

            $message = [
                'success' => 'Data berhasil disimpan.'
            ];

            // if (intval($row->stock) == 0) {
            //     $message = [
            //         'error' => 'Maaf, stok produk ini sudah habis.'
            //     ];
            // } else if (intval($row->stock) < $amount) {
            //     $message = [
            //         'error' => 'Maaf, stok tidak mencukupi.'
            //     ];
            // } else {
            //     $data = [
            //         'invoice' => $invoice_code,
            //         'barcode' => $barcode,
            //         'purchase_price' => $row->purchase_price,
            //         'selling_price' => $row->selling_price,
            //         'amount' => $amount,
            //         'sub_total' => floatval($row->selling_price) * $amount,
            //     ];

            //     DB::table('purchases_detail_temporary')->insert($data);

            //     // Kurangi stok produk
            //     DB::table('products')
            //         ->where('barcode', $barcode)
            //         ->increment('stock', $amount);

            //     $message = [
            //         'success' => 'Data berhasil disimpan.'
            //     ];
            // }
        } else {
            $message = [
                'error' => 'Data tidak ditemukan.'
            ];
        }

        return response()->json($message);
    }

    public function deletePurchaseDetailTemporaryItem(Request $request)
    {
        $id = $request->id;

        // Mengambil data item sebelum dihapus
        $item = DB::table('purchases_detail_temporary')->where('id', $id)->first();

        // Kembalikan stok produk
        DB::table('products')
            ->where('barcode', $item->barcode)
            ->decrement('stock', $item->amount);

        // Menggunakan Query Builder untuk mencari dan mengambil data
        $query = DB::table('purchases_detail_temporary')->where('id', $id)->delete();

        if ($query) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }

        $message = [
            'success' => $query,
        ];

        return response()->json($message);
    }
}
