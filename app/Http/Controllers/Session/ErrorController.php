<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function notFound(Request $request)
    {
        return response()->view('pages.errors.404', [], 404);
    }
}
