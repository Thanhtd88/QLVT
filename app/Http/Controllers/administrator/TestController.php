<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Imports\CustomerImport;
use App\Imports\PersonalImport;
use App\Models\administrator\Test;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('administrator.pages.test.index', compact('tests'));
    }

    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new PersonalImport, $request->file('import_file'));

        return redirect()->back()->with('status', 'Imported Successfully');
    }
}
