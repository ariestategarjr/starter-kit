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
}
