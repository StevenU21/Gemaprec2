<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportsExport implements FromCollection, WithHeadings
{
    protected $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    public function collection()
    {
        return $this->reports->map(function ($report) {
            return [
                'ID' => $report->id,
                'Code' => $report->code,
                'Description' => $report->description,
                'Client Name' => $report->client->user->name,
                'Maintenance Code' => $report->maintenance->code,
                'Maintenance Start Date' => $report->maintenance->start_date,
                'Maintenance End Date' => $report->maintenance->end_date,
                'Maintenance Status' => $report->maintenance->status,
                'Maintenance Observations' => $report->maintenance->observations,
                'Computer Name' => $report->maintenance->computer->name,
                'Computer Brand' => $report->maintenance->computer->brand->name,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Code',
            'Description',
            'Client Name',
            'Maintenance Code',
            'Maintenance Start Date',
            'Maintenance End Date',
            'Maintenance Status',
            'Maintenance Observations',
            'Computer Name',
            'Computer Brand',
        ];
    }
}
