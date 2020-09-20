<?php

namespace App\Exports;

use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PerusahaanExport implements FromView{
    use Exportable;
    public function __construct($perusahaan)
    {
        $this->perusahaan = $perusahaan;
    }
    public function view(): View{
        return view('cpanel.template.export', ['perusahaan' => $this->perusahaan]);
    }
}