<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleReportController extends Controller
{
    public function index(Request $request)
    {
        $period_from = $request->period_from;
        $period_to = $request->period_to;

        $query = DB::table('sales_detail')
            ->join('sales', 'sales.invoice', '=', 'sales_detail.invoice')
            ->join('products', 'products.barcode', '=', 'sales_detail.barcode')
            ->select('sales.*', 'products.*', 'sales_detail.*');

        if ($period_from && $period_to) {
            $query->whereBetween('sales.date', [$period_from, $period_to]);
        }
        // dd($query->get());

        $sales = $query->get();

        $sales_total = DB::table('sales_detail')
            ->join('sales', 'sales_detail.invoice', '=', 'sales.invoice')
            ->whereBetween('sales.date', [$period_from, $period_to])
            ->sum('sales_detail.sub_total');


        // return $period_to . gettype($period_from);
        // return view('pages.sales_report.index');

        return view('pages.sales_report.index', [
            'sales' => $sales,
            'sales_total' => $sales_total,
            'period_from' => $period_from,
            'period_to' => $period_to
        ]);
    }
}
