<?php

namespace Modules\User\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;

class VisitersExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents, WithTitle 
{

	use Exportable;
	
	public function __construct($data)
    {
        $this->data = $data;

        $this->fileName = 'errors';
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
    	return $this->data;
    }

    public function headings(): array
    {
        return [
            'Name',
			'EMAIL',
            'CONTACT NUMBER',
			'COUNTRY',
            'MEMBERS',
            'MEMBERS DETAIL',
            'DEPARTURE FROM INDORE',
            'DEPARTURE FROM UJJAIN',
            'CREATED AT'
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                // $cellRange = 'A1:AK1'; // All headers
                $cellRange = 'A1:H1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    public function title(): string
    {
        return $this->fileName;
    }
}
