<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class StatReportExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    protected $title;
    protected $data;

    public function __construct($title, $data)
    {
        $this->title = $title;
        $this->data = $data;
    }

    public function collection()
    {
        $rows = [];
        
        // إضافة بيانات تجريبية (يمكن استبدالها بالبيانات الحقيقية)
        for ($i = 7; $i >= 1; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $value = rand(100, 150);
            $change = rand(-10, 10);
            $status = $change >= 0 ? 'جيد' : 'متوسط';
            
            $rows[] = [
                'التاريخ' => $date,
                'القيمة' => $value,
                'التغيير' => ($change >= 0 ? '+' : '') . $change . '%',
                'الحالة' => $status,
            ];
        }
        
        return new Collection($rows);
    }

    public function headings(): array
    {
        return ['التاريخ', 'القيمة', 'التغيير', 'الحالة'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function title(): string
    {
        return 'تقرير ' . $this->title;
    }
}
