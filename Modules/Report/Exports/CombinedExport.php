<?php

namespace Modules\Report\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;

class CombinedExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents, WithTitle 
{

	use Exportable;
	
	public function __construct($data)
    {
        $this->data = $data;

        $this->fileName = 'Combined';
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
            'Hotel Name',
            'Total Inventory',
            'Payment Id',
            'Guest Name',
            'Contact',
            'Email Address',
            'Billing Address',
            'City',
            'State',
            'Country',
            'Postal Code',
            'User Id',
            'Registration Date',
            'Room Type',
            'Guest Count',
            'Booking Date',
            'Check In',
            'Check Out',
            'Booking Status',
            'Room / Night Charge',
            'Total Room Nights',
            'Adults',
            'Child',
            'Extra Bed',
            'Room Charges',
            'Extra Bed Charges',
            'GST (Taxes)',
            'GST (Tax%)',
            'Total Amount Paid',
            'Hotel Contact Person',
            'Hotel Contact No#',
            'Hotel Email-Id',
            'Payment Method',
            'Payment Via',
            'Transaction Id',
            'Transaction Status',
            'UTR No (If Any)',
            'Settlement Date',
            'Cancellation Date',
            'Cancellation Charges',
            'Refundable Amount',
            'Refund Date',
            'Refund Transaction UTR',
        ];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:AQ1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    public function title(): string
    {
        return $this->fileName;
    }
}
