<?php

namespace App\Exports;

use App\Models\Cita;
use Maatwebsite\Excel\Concerns\FromCollection;

class CitasExport implements FromCollection
{
	private $collection_;
    public function __construct($collection){
    	$this->collection_ = $collection;
    }

    public function collection()
    {
        return $this->collection_;
    }
}
