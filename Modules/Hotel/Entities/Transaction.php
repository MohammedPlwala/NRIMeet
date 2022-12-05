<?php
namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;
use OwenIt\Auditing\Contracts\Auditable;

class Transaction extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'transactions';
    protected $auditInclude = [
        'id', 'booking_id', 'transaction_id', 'payment_method', 'payment_mode' , 'payment_meta', 'status', 'created_at', 'updated_at'
    ];
}