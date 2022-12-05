<?php
namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;
use OwenIt\Auditing\Contracts\Auditable;

class BookingRoom extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'booking_rooms';

    protected $auditInclude = [
        'id', 'booking_id', 'room_id', 'amount', 'guests', 'adults', 'childs', 'guest_one_name', 'guest_two_name', 'guest_three_name', 'child_name', 'extra_bed', 'extra_bed_cost', 'created_at', 'updated_at'
    ];
}