<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;

class PdfController extends Controller
{
    public function index()
    {
        return view('admin_tools.pdf');
    }

    public function download()
    {
        $pdfClass = 'Barryvdh\\DomPDF\\Facade\\Pdf';

        if (! class_exists($pdfClass)) {
            return back()->with('error', 'Install DomPDF first: composer require barryvdh/laravel-dompdf');
        }

        $students = Student::with('degree')
            ->orderBy('lname')
            ->orderBy('name')
            ->get();

        $data = [
            'title' => 'Student Records Report',
            'date' => now()->format('F d, Y'),
            'students' => $students,
        ];

        return $pdfClass::loadView('pdf.report', $data)->download('student-records.pdf');
    }
}