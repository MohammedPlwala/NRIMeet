<?php
namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;
use OwenIt\Auditing\Contracts\Auditable;

class FailedTransaction extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'failed_transactions';
    protected $auditInclude = [
        'id', 'user_id', 'booking_id', 'hotel_id', 'transaction_id', 'status', 'error_message', 'unmappedstatus', 'mode', 'amount', 'response_data', 'created_at', 'updated_at'
    ];
}