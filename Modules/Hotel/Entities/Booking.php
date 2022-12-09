<?php
namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;
use OwenIt\Auditing\Contracts\Auditable;

class Booking extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'bookings';

    protected $auditInclude = [
        'id', 'order_id', 'user_id', 'hotel_id', 'confirmation_number', 'booking_type', 'check_in_date', 'check_out_date', 'nights', 'sub_total', 'tax', 'tax_percentage', 'amount', 'special_request', 'customer_booking_status','booking_status', 'created_at', 'updated_at','cancellation_request_date','settlement_date','utr_number'
    ];
}