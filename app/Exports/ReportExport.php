<?php
namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function collection()
    {
        return collect([
            [
                'ID' => $this->report->id,
                'Code' => $this->report->code,
                'Description' => $this->report->description,
                'Client Name' => $this->report->client->user->name,
                'Maintenance Code' => $this->report->maintenance->code,
                'Maintenance Start Date' => $this->report->maintenance->start_date,
                'Maintenance End Date' => $this->report->maintenance->end_date,
                'Maintenance Status' => $this->report->maintenance->status,
                'Maintenance Observations' => $this->report->maintenance->observations,
                'Computer Name' => $this->report->maintenance->computer->name,
                'Computer Brand' => $this->report->maintenance->computer->brand->name
            ]
        ]);
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
