<?php

namespace App\Http\Controllers;

use App\Exports\ExportNilai;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export(){
        // return 'hello';

        return Excel::download(new ExportNilai(), 'nilai.xlsx');
    }
}
