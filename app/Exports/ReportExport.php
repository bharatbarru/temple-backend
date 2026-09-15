<?php

namespace App\Exports;

use App\Services\ReportService;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * Writes any of the admin reports to a spreadsheet. All of the knowledge about
 * what a report contains lives in the ReportService, so the download always
 * matches what was on screen when the button was pressed.
 */
class ReportExport implements FromQuery, WithHeadings, WithMapping, WithTitle, WithStyles, WithColumnFormatting, ShouldAutoSize
{
    use Exportable;

    public function __construct(private ReportService $report)
    {
    }

    public function query()
    {
        return $this->report->query();
    }

    public function headings(): array
    {
        return $this->report->headings();
    }

    /**
     * @param Model $row
     */
    public function map($row): array
    {
        return $this->report->map($row);
    }

    public function title(): string
    {
        return $this->report->sheetTitle();
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * Keep the money columns numeric so they can be totalled in Excel.
     */
    public function columnFormats(): array
    {
        $formats = [];

        foreach ($this->report->amountColumns() as $index) {
            $formats[Coordinate::stringFromColumnIndex($index + 1)] = NumberFormat::FORMAT_NUMBER_00;
        }

        return $formats;
    }
}
