<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    function exportTotalRevenue()
    {
        $totalRevenue = $this->totalRevenueByOrders();

        $data = [
            'title' => 'Tổng doanh thu hàng bán theo ngày',
            'date' => date('d/m/Y'),
            'totalRevenue' => $totalRevenue
        ];

        $pdf = FacadePdf::loadView('order.export-total-revenue', $data);

        return $pdf->download('danhsachdoanhthutheongay.pdf');
    }
}
