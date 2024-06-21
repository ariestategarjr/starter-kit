<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    public function index()
    {
        return view('pages.purchases_report.index');
    }
}
