<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class QuotationExport implements FromView
{
private $quotation;
private $quotation1;
/**
* @return \Illuminate\Support\Collection
*/
public function __construct($quotation,$quotation1)
{
$this->quotation = $quotation;
$this->quotation1 = $quotation1;
} 

public function view(): View
{
    return view('exports.excel', [
        'quotation' => $this->quotation,
        'quotation1' => $this->quotation1
    ]);
}
}