<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Pastikan sudah install package barryvdh/laravel-dompdf
use App\Models\ReportLog; // Model untuk simpan log

class ReportController extends Controller
{
    public function index(){
        return view('report');
    }

    public function generatePdf(Request $request, $cust)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // TODO: Ganti dengan query data yang kamu butuhkan sesuai tanggal
        $data = []; 

        // Generate PDF dari view pdf.report (kamu buat nanti)
        // $pdf = PDF::loadView('pdf.report', compact('data', 'startDate', 'endDate'));

        // Simpan log generate report
        // ReportLog::create([
        //     'customer' => $cust,
        //     'start_date' => $startDate,
        //     'end_date' => $endDate,
        //     'generated_at' => now(),
        //     'user_id' => auth()->id() ?? null,
        // ]);

        // Download file PDF
        // return $pdf->download("report_{$startDate}_to_{$endDate}.pdf");
    }
}
