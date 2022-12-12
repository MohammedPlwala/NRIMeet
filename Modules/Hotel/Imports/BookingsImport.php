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
            $rowNo = $key+2;
            
            $importError = 0;


            echo "<pre>"; print_r($row); die;
            
            if($sale_price > $regular_price){
                $sale_price = $regular_price;
            }

            if(!empty($row['guest_email'])){
                $user = User::select('id','name')
                ->where('email',$row['guest_email'])
                ->first();
                if($user){
                    $userId =  $user->id;
                }else{
                    $userId =  Null;
                }
            }else{
                $manufacturerId =  Null;
            }

            if(!empty($row['manufacturer']) && $manufacturerId == Null){

                $newManufacturer = new Manufacturer();
                $newManufacturer->name = $row['manufacturer'];
                $newManufacturer->organization_id = $this->organization_id;
                $slug = \Str::slug($row['manufacturer'], "-");

                if (strlen($slug) > \Config::get('constants.SLUG_CHARACTER_LIMIT'))
                    $slug = substr($slug, 0, \Config::get('constants.SLUG_CHARACTER_LIMIT'));
                
                $newManufacturer->slug = $slug;
                $newManufacturer->save();
                $manufacturerId = $newManufacturer->id;
            }

                if($importError == 0){

                    $productSlug = Str::slug($row['name'], "_").'-'.$rowNo;

                    $product = Product::create([
                                    'name' => $row['name'],
                                    'status' => 'active',
                                    'slug' => $productSlug,
                                    'organization_id' => $this->organization_id,
                                    'manufacturer_id' => $manufacturerId,
                                    'type' => 'simple',
                                    'created_by' => $this->importedBy,
                                ]);
                    if($product->id){

                        $productSku = new SKU();
                        $productSku->code = $row['sku_code'];
                        $productSku->moq = $row['moq'];
                        $productSku->regular_price = $regular_price;
                        $productSku->sale_price = $sale_price;
                        $productSku->inventory = 'finite';
                        $productSku->inventory_value = 1;

                        $productSku->gst = 0;
                        if(!empty($row['gst'])){
                            $productSku->gst = $row['gst'];
                        }

                        $productSku->part_number = 0;
                        if(!empty($row['part_number'])){
                            $productSku->part_number = $row['part_number'];
                        }

                        $productSku->product_id = $product->id;
                        $productSku->status = 'active';
                        $productSku->created_by = $this->importedBy;
                        $productSku->save();

                        $productCategory = array('product_id' => $product->id,'category_id' => $categoryId);
                        ProductCategory::insert($productCategory);

                        if(!empty($row['model']) && $modelId != ""){
                            $productModel = array('product_id' => $product->id,'model_id' => $modelId);
                            ProductModel::insert($productModel);
                        }

                        $productBrand = array('product_id' => $product->id,'brand_id' => $brandId);
                        ProductBrand::insert($productBrand);

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