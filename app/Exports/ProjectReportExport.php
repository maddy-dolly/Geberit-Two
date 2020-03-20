<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProjectReportExport implements FromView
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
    return view('exports.projectreport', [
        'quotation' => $this->quotation,
    ]);
}
}