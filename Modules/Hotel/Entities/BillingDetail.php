<?php
namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;
use OwenIt\Auditing\Contracts\Auditable;

class BillingDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'billing_details';

    protected $auditInclude = [
        'id', 'booking_id', 'first_name', 'last_name', 'company_name', 'country', 'state_province', 'city', 'zip_code', 'address_1', 'address_2', 'pbd_registration_number', 'phone', 'email', 'alternate_phone', 'alternate_email', 'created_at', 'updated_at'
    ];
}