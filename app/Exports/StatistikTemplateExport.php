<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StatistikTemplateExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected Collection $rows;
    protected string $labelColumn;
    protected string $labelHeading;
    protected array $extraColumns;

    public function __construct(Collection $rows, string $labelColumn, string $labelHeading, array $extraColumns = [])
    {
        $this->rows = $rows;
        $this->labelColumn = $labelColumn;
        $this->labelHeading = $labelHeading;
        $this->extraColumns = $extraColumns;
    }

    public function collection(): Collection
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return array_merge(
            [$this->labelHeading, 'Laki-laki', 'Perempuan'],
            array_values($this->extraColumns)
        );
    }

    public function map($row): array
    {
        $line = [$row->{$this->labelColumn}, $row->laki_laki, $row->perempuan];

        foreach (array_keys($this->extraColumns) as $col) {
            $line[] = $row->{$col};
        }

        return $line;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}