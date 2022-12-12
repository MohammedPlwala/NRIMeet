<?php

namespace Modules\Hotel\Imports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;
use Modules\Ecommerce\Entities\ImportResult;
use Illuminate\Support\Str;
use App\Notifications\ImportHasFailedNotification;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;
use Modules\Hotel\Entities\Booking;
use Modules\Hotel\Entities\BookingRoom;
use Modules\Hotel\Entities\BillingDetail;
use Modules\Hotel\Entities\Transaction;
use Modules\User\Entities\Role;
use Modules\User\Entities\UserRole;

class BookingsImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    // WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    // ShouldQueue,
    WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public $data;
    public $row_errors;
    public $rows_imported;

    public function __construct($organization_id,$importedBy,$result_id = 0)
    {
        $this->importedBy = $importedBy;
        $this->organization_id = $organization_id;
        $this->result_id = $result_id;
        $this->todaydate    = date("Y-m-d");
        $this->logPath      = base_path().'/logs/';
        $this->rows_imported      = 0;
    }

    public function log_errors($result_id,$new_error){
        $checkResult = ImportResult::findOrfail($result_id);
        if(!empty($checkResult->errors)){
            $errors = json_decode($checkResult->errors,true);
        }else{
            $errors = array();
        }
        $errors[] = $new_error;
        $checkResult->errors = json_encode($errors);
        $checkResult->save();
    }


    public function collection(Collection $rows)
    {
        $errors = array();
        $success = array();
        $item = array();
        foreach ($rows as $key => $row) {
            $importError = 0;

            if($row['booking_type'] == 'Offline'){
                $importError = 1;
            }

            $rowNo = $key+2;
            
        

            if(!empty($row['guest_email'])){
                $user = User::select('id','city','state','country','zip','full_name')
                ->where('email',$row['guest_email'])
                ->first();
                if($user){
                    $userId =  $user->id;
                }else{
                    $user = new User();
                    $user->email = $row['guest_email'];
                    $user->full_name = $row['guest_name'];
                    $user->status = 'active';
                    $user->save();
                    $userId =  $user->id;

                    $userRole = array('role_id' => 3, 'user_id' =>  $user->id);
                    UserRole::insert($userRole);
                }
            }else{
                $email = str_replace(' ', '_', $row['guest_name']);
                $email = strtolower($email);
                $email = $email.'@yopmail.com';

                $user = User::select('id','city','state','country','zip','full_name')
                ->where('email',$email)
                ->first();

                if($user){
                    $userId =  $user->id;
                }else{
                    $user = new User();
                    $user->email = $email;
                    $user->full_name = $row['guest_name'];
                    $user->status = 'active';
                    $user->save();
                    $userId =  $user->id;

                    $userRole = array('role_id' => 3, 'user_id' =>  $user->id);
                    UserRole::insert($userRole);
                }

            }

            
            if($importError == 0){

                $booking = new Booking();

                $booking->order_id = $row['order_id'];
                $booking->user_id = $userId;
                $booking->hotel_id = $row['hotel_id'];
                $booking->booking_type = 'Online';

                // $booking->check_in_date =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['check_in_date'])->format('Y-m-d');
                // $booking->check_out_date =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['check_out_date'])->format('Y-m-d');

                $booking->check_in_date = date('Y-m-d',strtotime($row['check_in_date']));
                $booking->check_out_date = date('Y-m-d',strtotime($row['check_out_date']));
            
                $booking->nights = $row['nights'];

                $row['amount'] = str_replace(',', '', $row['amount']);
                $row['tax'] = str_replace(',', '', $row['tax']);
                $amount = $row['amount'];
                $tax = $row['tax'];
                $sub_total = $amount-$tax;

                $booking->tax = $tax;
                $booking->amount = $amount;
                $booking->sub_total = $amount-$tax;
                
                if(!empty($row['confirmation_number'])){
                    $booking->confirmation_number = $row['confirmation_number'];
                }

                if(!empty($row['special_request'])){
                    $booking->special_request = $row['special_request'];
                }
                
                if(!empty($row['utr_number'])){
                    $booking->utr_number = $row['utr_number'];
                }
                if(!empty($row['settlement_id'])){
                    $booking->settlement_id = $row['settlement_id'];
                }

                if(!empty($row['settlement_date'])){
                    // $booking->settlement_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['settlement_date'])->format('Y-m-d');

                    $booking->settlement_date = date('Y-m-d',strtotime($row['settlement_date']));
                }

                if(!empty($row['cancellation_request_date'])){
                    // $booking->cancellation_request_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['cancellation_request_date'])->format('Y-m-d');
                    $booking->cancellation_request_date = date('Y-m-d',strtotime($row['cancellation_request_date']));
                }

                if(!empty($row['refund_request_date'])){
                    // $booking->refund_request_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['refund_request_date'])->format('Y-m-d');
                    $booking->refund_request_date = date('Y-m-d',strtotime($row['refund_request_date']));
                }


                if(!empty($row['cancellation_date'])){
                    // $booking->cancellation_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['cancellation_date'])->format('Y-m-d');
                    $booking->cancellation_date = date('Y-m-d',strtotime($row['cancellation_date']));
                }

                if(!empty($row['refund_date'])){
                    $booking->refund_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['refund_date'])->format('Y-m-d');
                    $booking->refund_date = date('Y-m-d',strtotime($row['refund_date']));
                }

                if(!empty($row['cancellation_charges'])){
                    $booking->cancellation_charges = $row['cancellation_charges'];
                }

                if(!empty($row['refundable_amount'])){
                    $booking->refundable_amount = $row['refundable_amount'];
                }

                if(!empty($row['refund_transaction_utr'])){
                    $booking->refund_transaction_utr = $row['refund_transaction_utr'];
                }

                if($row['booking_status'] == 'Confirmation Pending'){
                    
                    $booking->customer_booking_status = 'Received';
                    $booking->booking_status = 'Payment Completed';

                    if(!empty($row['confirmation_number'])){
                        $booking->customer_booking_status = 'Confirmed';
                        $booking->booking_status = 'Confirmation Recevied';
                    }

                }elseif($row['booking_status'] == 'Confirmaiton Done'){
                    $booking->customer_booking_status = 'Confirmed';
                    $booking->booking_status = 'Confirmation Recevied';
                }else{
                    $booking->customer_booking_status = 'Received';
                    $booking->booking_status = 'Payment Completed';
                }
                
                if($booking->save()){
                    $room = new BookingRoom();
                    $room->booking_id = $booking->id;

                    $roomType = HotelRoom::from('hotel_rooms as hr')
                                ->select('hr.id as room_id')
                                ->join('room_types as rt','rt.id','=','hr.type_id')
                                ->where('hotel_id',$row['hotel_id'])
                                ->where('rt.name', 'like', '%' . $row['room_type'] . '%')
                                ->first();

                    $room->room_id = $roomType->room_id;
                    $room->tax_percentage = $row['tax_percentage'];
                    $room->tax = $row['tax'];
                    $room->amount = $row['amount'];

                    if($row['room_guests'] != "-" && $row['room_guests'] != ""){
                        $room->guests = $row['room_guests'];
                    }else{
                        $room->guests = 2;
                    }

                    if($row['room_adults'] != "-" && $row['room_adults'] != ""){
                        $room->adults = $row['room_adults'];
                    }else{
                        $room->adults = 2;
                    }

                    if($row['room_childs'] != "-" && $row['room_childs'] != ""){
                        $room->childs = $row['room_childs'];
                    }

                    if(!empty($row['room_guest_one_name'])){
                        $room->guest_one_name = $row['room_guest_one_name'];
                    }

                    if(!empty($row['room_guest_two_name'])){
                        $room->guest_two_name = $row['room_guest_two_name'];
                    }

                    if(!empty($row['room_guest_three_name'])){
                        $room->guest_three_name = $row['room_guest_three_name'];
                    }

                    if(!empty($row['room_child_name'])){
                        $room->child_name = $row['room_child_name'];
                    }

                    $room->extra_bed = 0;
                    $room->extra_bed_cost = 0;
                    $room->save();

                    $hotelRoom = HotelRoom::findorfail($roomType->room_id);
                    if($hotelRoom){
                        $hotelRoom->count = $hotelRoom->count-1;
                        $hotelRoom->save();
                    }

                    $billingDetail = new BillingDetail();

                    $billingDetail->booking_id = $booking->id;

                    $first_name = $user->full_name;
                    $last_name = "";
                    $usernames = explode(' ', $user->full_name);
                    foreach ($usernames as $u => $username) {
                        if($u == 0){
                            $first_name = $username;
                        }else{
                            $last_name .= $username.' ';
                        }
                    }

                    $billingDetail->first_name = $first_name;
                    $billingDetail->last_name = $last_name;
                    $billingDetail->country = $user->country;
                    $billingDetail->state_province = $user->state;
                    $billingDetail->city = $user->city;
                    $billingDetail->zip_code = $user->zip;
                    $billingDetail->address_1 = $user->address;
                    $billingDetail->phone = $user->mobile;
                    $billingDetail->email = $user->email;
                    $billingDetail->save();

                    $transaction = new Transaction();
                    $transaction->booking_id = $booking->id;
                    $transaction->transaction_id = $row['transaction_id'];
                    $transaction->payment_method = ucfirst($row['payment_method']);
                    $transaction->payment_mode = 'Online';
                    $transaction->payment_channel = $row['payment_channel'];
                    $transaction->status = 'confirmed';
                    $transaction->save();
                    

                    $success[] = $rowNo;
                    $this->rows_imported++;
                }else{
                    $errors[] = array(
                                    
                                    'name' => $row['name'],
                                    'sku_code' => $row['sku_code'],
                                    'message' => 'Not imported'
                                );
                }
            }
            
        }

        if(!empty($success)){
            $this->data =   array(
                                'success' => $success,
                                'errors' => $errors
                            );
        }else{
            if(!empty($errors)){
                $this->data =   array(
                                'success'   => array(),
                                'errors'    => $errors
                            );
            } else{

                $this->data =   array(
                                    'success'   => array(),
                                    'errors'    => array(
                                                    'row' => 1,
                                                    'message' => 'There seems some error in importing file.'
                                                )
                                );
            }
        }
    }

    /*public function rules(): array
    {
        return [
            'name' => 'required|string',
            'category' => 'required|string',
            'brand' => 'required|string',
            'manufacturer' => 'required|string',
            'moq' => 'numeric|min:1|max:100',
            'sale_price' => 'numeric|min:1|max:1000000',
            'regular_price' => 'numeric|min:1|max:1000000',
            'sku_code' => 'required|max:10|unique:ecommerce_sku,code'
        ];
        DELETE FROM ecommerce_products where id > 0;
        DELETE FROM ecommerce_sku where product_id > 0;
        DELETE FROM ecommerce_product_brand where product_id > 0;
        DELETE FROM ecommerce_category_product where product_id > 0;
        DELETE FROM ecommerce_product_model where product_id > 0;
        DELETE FROM ecommerce_product_segment where product_id > 0;
        DELETE FROM ecommerce_product_tag where product_id > 0;
        DELETE FROM ecommerce_product_media where product_id > 0;
    }*/


    public function chunkSize(): int
    {
        return 3300;
    }



    /*public static function afterImport(AfterImport $event)
    {
        $concerns = $event->getConcernable();
        $message = 'import error'.json_encode($concerns->rows_imported);
        error_log($message."\n\n", 3,$this->logPath . $this->todaydate . '-import.log');

        $result = new ImportResult();
        $result->organization_id = $concerns->organization_id;
        $result->rows_imported = $concerns->rows_imported;
        $result->errors = json_encode($concerns->row_errors);
        $result->save();
    }*/

    public function onFailure(Failure ...$failures)
    {
        // // $this->failures = array_merge($this->failures, $failures);
        // // $visit->updated_log_time = date('Y-m-d H:i:s');
        // // echo "<pre>";
        // // print_r($failures-to);
        // // die;

        // $message = 'sdasdsa'.json_encode($failures);
        // error_log($message."\n\n", 3,$this->logPath . $this->todaydate . '-import.log');

        // // Will skip this row
    }

    public function failures()
    {
        // return $this->failures;
    }
}