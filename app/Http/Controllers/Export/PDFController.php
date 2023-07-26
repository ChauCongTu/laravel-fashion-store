<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class PDFController extends Controller
{
    public function index ($id){
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.orders.export', compact('order'));
        $fileName = Str::random(10) . '.pdf';
        // dd($fileName);
        return $pdf->stream($fileName);
    }
}
