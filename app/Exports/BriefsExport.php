<?php

namespace App\Exports;

use App\Models\Brief;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BriefsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Brief::with('user')->orderBy('created_at', 'desc')->get();
    }
    
    public function headings(): array
    {
        return [
            'ID',
            'Client Name',
            'Client Email',
            'Project Name',
            'Categories',
            'Budget',
            'Description',
            'Status',
            'Created At'
        ];
    }
    
    public function map($brief): array
    {
        return [
            $brief->id,
            $brief->user->name ?? '-',
            $brief->user->email ?? '-',
            $brief->project_name,
            is_array($brief->categories) ? implode(', ', $brief->categories) : $brief->categories,
            $brief->budget ?? 0,
            strip_tags($brief->description ?? '-'),
            $brief->status,
            $brief->created_at->format('d/m/Y H:i'),
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}