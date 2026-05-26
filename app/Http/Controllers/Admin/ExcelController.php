<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function index()
    {
        return view('admin_tools.excel');
    }

    public function export()
    {
        $excelClass = 'Maatwebsite\\Excel\\Facades\\Excel';

        if (! class_exists($excelClass)) {
            return back()->with('error', 'Install Laravel Excel first: composer require maatwebsite/excel');
        }

        return $excelClass::download(new StudentsExport(), 'students.xlsx');
    }

    public function import(Request $request)
    {
        $excelClass = 'Maatwebsite\\Excel\\Facades\\Excel';

        if (! class_exists($excelClass)) {
            return back()->with('error', 'Install Laravel Excel first: composer require maatwebsite/excel');
        }

        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        $excelClass::import(new StudentsImport(), $request->file('file'));

        return back()->with('success', 'Records imported successfully.');
    }
}
