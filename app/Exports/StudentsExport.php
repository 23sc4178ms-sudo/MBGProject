<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Student::with('degree')
            ->orderBy('lname')
            ->orderBy('name')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Student ID',
            'First Name',
            'Middle Name',
            'Last Name',
            'Full Name',
            'Email',
            'Contact',
            'Degree',
            'Date Added',
        ];
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->mname,
            $student->lname,
            trim($student->name.' '.($student->mname ? $student->mname.' ' : '').$student->lname),
            $student->email,
            $student->contact,
            optional($student->degree)->Degree ?? 'N/A',
            optional($student->created_at)->format('Y-m-d H:i'),
        ];
    }
}