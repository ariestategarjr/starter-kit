<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseReportController extends Controller
{
    public function index(Request $request)
    {
        $period_from = $request->period_from;
        $period_to = $request->period_to;

        $query = DB::table('purchases_detail')
            ->join('purchases', 'purchases.invoice', '=', 'purchases_detail.invoice')
            ->join('products', 'products.barcode', '=', 'purchases_detail.barcode')
            ->select('purchases.*', 'products.*', 'purchases_detail.*');

        if ($period_from && $period_to) {
            $query->whereBetween('purchases.date', [$period_from, $period_to]);
        }
        // dd($query->get());

        $purchases = $query->get();

        $purchases_total = DB::table('purchases_detail')
            ->join('purchases', 'purchases_detail.invoice', '=', 'purchases.invoice')
            ->whereBetween('purchases.date', [$period_from, $period_to])
            ->sum('purchases_detail.sub_total');


        // return $period_to . gettype($period_from);
        // return view('pages.sales_report.index');

        return view('pages.purchases_report.index', [
            'purchases' => $purchases,
            'purchases_total' => $purchases_total,
            'period_from' => $period_from,
            'period_to' => $period_to
        ]);
    }
}
