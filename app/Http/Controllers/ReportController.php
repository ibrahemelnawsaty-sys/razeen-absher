<?php

namespace App\Http\Controllers;

use App\Exports\StatReportExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function exportExcel(Request $request)
    {
        $title = $request->input('title', 'الإحصائية');
        $data = $request->input('data', []);
        
        $filename = 'تقرير_' . $title . '_' . now()->format('Y-m-d') . '.xlsx';
        
        return Excel::download(new StatReportExport($title, $data), $filename);
    }

    public function exportPdf(Request $request)
    {
        $title = $request->input('title', 'الإحصائية');
        $value = $request->input('value', 'N/A');
        $trend = $request->input('trend', 'N/A');
        $weeklyAvg = $request->input('weeklyAvg', 'N/A');
        $peak = $request->input('peak', 'N/A');
        $lowest = $request->input('lowest', 'N/A');
        
        // بيانات تجريبية للجدول
        $tableData = [];
        for ($i = 7; $i >= 1; $i--) {
            $tableData[] = [
                'date' => now()->subDays($i)->format('Y-m-d'),
                'value' => rand(100, 150),
                'change' => rand(-10, 10),
                'status' => rand(0, 1) ? 'جيد' : 'متوسط',
            ];
        }
        
        $data = compact('title', 'value', 'trend', 'weeklyAvg', 'peak', 'lowest', 'tableData');
        
        $pdf = Pdf::loadView('reports.stat-report', $data)
            ->setPaper('a4', 'portrait')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);
        
        $filename = 'تقرير_' . $title . '_' . now()->format('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }
}
