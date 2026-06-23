<?php

namespace App\Exports;

use App\Models\students;
use App\Models\rayons;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class psLatesExport implements FromCollection, WithHeadings
{
    protected $pslates;

    public function __construct()
    {
        $rayonIds = rayons::where('user_id', Auth::user()->id)->pluck('id');
        $this->pslates = students::whereIn('rayon_id', $rayonIds)->get();
    }

    public function collection()
    {
        return students::with(['rombels', 'rayons', 'lates'])
            ->whereIn('rayon_id', $this->pslates->pluck('rayon_id'))
            ->select('nis', 'name', 'rombel_id', 'rayon_id')
            ->withCount('lates') // Ensure that the relationship name is 'lates'
            ->get()
            ->map(function ($student) {
                return [
                    'NIS' => $student->nis,
                    'Nama' => $student->name,
                    'Rombel' => $student->rombels ? $student->rombels->rombel : null,
                    'Rayon' => $student->rayons ? $student->rayons->rayon : null,
                    'Total Keterlambatan' => $student->lates_count,
                ];
            });
    }

    public function headings(): array
    {
        return ['NIS', 'Nama', 'Rombel', 'Rayon', 'Total Keterlambatan'];
    }
}
