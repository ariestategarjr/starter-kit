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
            "SELECT MAX(invoice) AS invoice FROM purchases
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

        return response()->json([
            'data' => view('pages.purchases.partials.detail', compact('result'))->render()
        ]);
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

    public function deletePurchaseDetailTemporary(Request $request)
    {
        $invoice_code = $request->invoice_code;

        // Mengambil semua rincian penjualan sementara untuk invoice tertentu
        $items = DB::table('purchases_detail_temporary')->where('invoice', $invoice_code)->get();

        // Mengembalikan stok produk untuk setiap rincian penjualan sementara
        foreach ($items as $item) {
            DB::table('products')
                ->where('barcode', $item->barcode)
                ->decrement('stock', $item->amount);
        }

        // Delete all records from the 'temp_penjualan' table
        $query = DB::table('purchases_detail_temporary')->delete();

        // Prepare the response message
        if ($query) {
            $message = [
                'success' => 'Transaksi berhasil dihapus.'
            ];
        } else {
            $message = [
                'error' => 'Gagal menghapus transaksi.'
            ];
        }

        // Return the response as JSON
        return response()->json($message);
    }

    // sale operations
    public function showPurchaseModal(Request $request)
    {
        $invoice_code = $request->invoice_code;
        $supplier = $request->supplier;

        $total = DB::table('purchases_detail_temporary')
            ->select(DB::raw('SUM(sub_total) as total'))
            ->where('invoice', $invoice_code)
            ->first();
        $query = DB::table('purchases_detail_temporary')
            ->where('invoice', $invoice_code);
        if ($query->count() > 0) {
            // Data yang akan dikirim ke modal
            $data = [
                'invoice_code' => $invoice_code,
                'supplier' => $supplier,
                'total' => $total->total,
            ];
            $view = view('pages.purchases.modals.purchase', $data)->render();
            $message = [
                'data' => $view
            ];
        } else {
            $message = [
                'error' => 'Transaksi belum ada.'
            ];
        }
        return response()->json($message);
    }

    public function storePurchase(Request $request)
    {
        $invoice_code = $request->invoice_code;
        $supplier = $request->supplier;
        $total_gross = $request->total_gross;
        $total_net = str_replace(',', '', $request->total_net); // , . 
        $discount_percent = str_replace(',', '', $request->discount_percent); // .
        $discount_cash = str_replace(',', '', $request->discount_cash); // .
        $payment_money = str_replace(',', '', $request->payment_money); // . ,
        $change_money = str_replace(',', '', $request->change_money); // . ,

        // Jika nilai $customer bernilai 0 atau falsy, ubah menjadi NULL
        $supplier = $supplier ? $supplier : NULL;

        // Store Sale
        $dataPurchases = [
            'invoice' => $invoice_code,
            'date' => date('Y-m-d H:i:s'),
            'supplier_id' => $supplier,
            'discount_percent' => $discount_percent,
            'discount_cash' => $discount_cash,
            'total_gross' => $total_gross,
            'total_net' => $total_net,
            'payment_money' => $payment_money,
            'change_money' => $change_money,
        ];
        DB::table('purchases')->insert($dataPurchases);

        // Store Sale Detail
        $dataPurchaseDetailTemporary = DB::table('purchases_detail_temporary')
            ->where('invoice', $invoice_code)
            ->get();

        $dataPurchasesDetail = [];
        foreach ($dataPurchaseDetailTemporary as $row) {
            $dataPurchasesDetail[] = [
                'invoice' => $row->invoice,
                'barcode' => $row->barcode,
                'purchase_price' => $row->purchase_price,
                'selling_price' => $row->selling_price,
                'amount' => $row->amount,
                'sub_total' => $row->sub_total,
            ];
        }

        // Menyisipkan data ke tabel detail_sale secara batch
        DB::table('purchases_detail')->insert($dataPurchasesDetail);

        // Mengosongkan tabel temp_sale
        DB::table('purchases_detail_temporary')->truncate();

        $message = [
            'success' => gettype($supplier),
        ];
        return response()->json($message);
    }
}
