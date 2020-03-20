<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProjectPLReportExport implements FromView
{
private $quotation;
/**
* @return \Illuminate\Support\Collection
*/
public function __construct($quotation)
{
$this->quotation = $quotation;
} 

public function view(): View
{
    return view('exports.projectplreport', [
        'quotation' => $this->quotation,
    ]);
}
}