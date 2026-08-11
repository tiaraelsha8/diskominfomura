<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StatistikImport implements ToCollection
{
    protected string $modelClass;
    protected string $labelColumn;
    protected array $extraColumns;

    public int $updated = 0;
    public array $tidakDikenali = [];

    public function __construct(string $modelClass, string $labelColumn, array $extraColumns = [])
    {
        $this->modelClass = $modelClass;
        $this->labelColumn = $labelColumn;
        $this->extraColumns = $extraColumns;
    }

    public function collection(Collection $rows): void
    {
        foreach ($rows->skip(1) as $row) {
            $label = trim((string) ($row[0] ?? ''));

            if ($label === '') {
                continue;
            }

            $lakiLaki  = (int) ($row[1] ?? 0);
            $perempuan = (int) ($row[2] ?? 0);

            $record = ($this->modelClass)::where($this->labelColumn, $label)->first();

            if (!$record) {
                $this->tidakDikenali[] = $label;
                continue;
            }

            $data = [
                'laki_laki' => max(0, $lakiLaki),
                'perempuan' => max(0, $perempuan),
            ];

            foreach ($this->extraColumns as $i => $col) {
                $data[$col] = max(0, (int) ($row[3 + $i] ?? 0));
            }

            $record->update($data);
            $this->updated++;
        }
    }
}