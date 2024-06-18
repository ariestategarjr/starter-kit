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

    public function sumSubTotalToTotal(Request $request)
    {
        // Ambil nilai fakturcode dari request
        $invoice_code = $request->invoice_code;

        // Query database untuk mendapatkan totalbayar
        $result = DB::table('sales_detail_temporary')
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

    // modal - customer
    public function showCustomersModal()
    {
        return response()->json(['modal' => true]);
    }

    // modal - product data
    public function showCustomersModalData(Request $request)
    {
        $query = DB::table('customers')->select('*');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('customers.name', 'like', '%' . $search . '%');
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

    // sale detail operations
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

    public function deleteSaleDetailTemporaryItem(Request $request)
    {
        $id = $request->id;

        // Menggunakan Query Builder untuk mencari dan mengambil data
        $query = DB::table('sales_detail_temporary')->where('id', $id)->delete();

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

    public function deleteSaleDetailTemporary(Request $request)
    {
        // Delete all records from the 'temp_penjualan' table
        $query = DB::table('sales_detail_temporary')->delete();

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
    public function showSaleModal(Request $request)
    {
        $invoice_code = $request->invoice_code;
        $customer = $request->customer;

        $total = DB::table('sales_detail_temporary')
            ->select(DB::raw('SUM(sub_total) as total'))
            ->where('invoice', $invoice_code)
            ->first();
        $query = DB::table('sales_detail_temporary')
            ->where('invoice', $invoice_code);
        if ($query->count() > 0) {
            // Data yang akan dikirim ke modal
            $data = [
                'invoice_code' => $invoice_code,
                'customer' => $customer,
                'total' => $total->total,
            ];
            $view = view('pages.sales.modals.sale', $data)->render();
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

    public function storeSale(Request $request)
    {
        $invoice_code = $request->invoice_code;
        $customer = $request->customer;
        $total_gross = $request->total_gross;
        $total_net = str_replace(',', '', $request->total_net); // , . 
        $discount_percent = str_replace(',', '', $request->discount_percent); // .
        $discount_cash = str_replace(',', '', $request->discount_cash); // .
        $payment_money = str_replace(',', '', $request->payment_money); // . ,
        $change_money = str_replace(',', '', $request->change_money); // . ,

        // Jika nilai $customer bernilai 0 atau falsy, ubah menjadi NULL
        $customer = $customer ? $customer : NULL;

        // Store Sale
        $dataSales = [
            'invoice' => $invoice_code,
            'date' => date('Y-m-d H:i:s'),
            'customer_id' => $customer,
            'discount_percent' => $discount_percent,
            'discount_cash' => $discount_cash,
            'total_gross' => $total_gross,
            'total_net' => $total_net,
            'payment_money' => $payment_money,
            'change_money' => $change_money,
        ];
        DB::table('sales')->insert($dataSales);

        // Store Sale Detail
        $dataSaleDetailTemporary = DB::table('sales_detail_temporary')
            ->where('invoice', $invoice_code)
            ->get();

        $dataSalesDetail = [];
        foreach ($dataSaleDetailTemporary as $row) {
            $dataSalesDetail[] = [
                'invoice' => $row->invoice,
                'barcode' => $row->barcode,
                'purchase_price' => $row->purchase_price,
                'selling_price' => $row->selling_price,
                'amount' => $row->amount,
                'sub_total' => $row->sub_total,
            ];
        }

        // Menyisipkan data ke tabel detail_sale secara batch
        DB::table('sales_detail')->insert($dataSalesDetail);

        // Mengosongkan tabel temp_sale
        DB::table('sales_detail_temporary')->truncate();

        $message = [
            'success' => gettype($customer),
        ];
        return response()->json($message);
    }
}
