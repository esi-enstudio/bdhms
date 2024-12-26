<?php

namespace App\Exports;

use App\Models\Commission;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CommissionExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    protected $filters;

    // Constructor to accept filters
    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        // Apply filters and manipulate data
        return Commission::query()
            ->when($this->filters['dd_house_id'] ?? null, fn($query, $dd_house_id) => $query->where('dd_house_id', $dd_house_id))
            ->when($this->filters['for'] ?? null, fn($query, $for) => $query->where('for', $for))
            ->when($this->filters['type'] ?? null, fn($query, $type) => $query->where('type', $type))
            ->when($this->filters['month'] ?? null, fn($query, $month) => $query->where('month', $month))
            ->when($this->filters['received_date'] ?? null, fn($query, $received_date) => $query->whereDate('received_date', $received_date))
            ->get();
    }

    // Manipulate data
    public function map($commission): array
    {
        return [
            $commission->dd_house_id,
            $commission->ddHouse->name ?? 'Unknown',
            $commission->for,
            $commission->type,
            $commission->month,
            // Convert received_date to an Excel-supported date format
            Carbon::parse($commission->received_date)->format('Y-m-d'),
        ];
    }

    public function headings(): array
    {
        return [
            'DD House',
            'Commission For',
            'Commission Type',
            'Month',
            'Received Date',
        ];
    }
}
