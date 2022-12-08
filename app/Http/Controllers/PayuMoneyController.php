<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class PayuMoneyController
 */
class PayuMoneyController extends \InfyOm\Payu\PayuMoneyController
{

    const TEST_URL = 'https://sandboxsecure.payu.in';
    const PRODUCTION_URL = 'https://secure.payu.in';

    public function paymentCancel(Request $request)
    {
        $data = $request->all();
        echo "<pre>";
        print_r($data);
        die;
        // your code here
    }
    
    public function paymentSuccess(Request $request)
    {
        $data = $request->all();
        echo "<pre>";
        print_r($data);
        die;
        $validHash = $this->checkHasValidHas($data);
        
        if (!$validHash) {
            echo "Invalid Transaction. Please try again";
        } else {


            echo "Payment successful";
        }
    }

    public function redirectToPayU(Request $request)
    {
        $data = $request->all();
        echo "<pre>";
        print_r($data);
        die;

        $MERCHANT_KEY = config('payu.merchant_key');
        $SALT = config('payu.salt_key');

        $PAYU_BASE_URL = config('payu.test_mode') ? self::TEST_URL : self::PRODUCTION_URL;
        $action = '';

        $posted = array();
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $posted[$key] = $value;
            }
        }

        $formError = 0;

        if (empty($posted['txnid'])) {
            // Generate random transaction id
            $txnid = substr(hash('sha256', mt_rand().microtime()), 0, 20);
        } else {
            $txnid = $posted['txnid'];
        }
        $hash = '';
        // Hash Sequence
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if (empty($posted['hash']) && sizeof($posted) > 0) {
            if (
                empty($posted['key'])
                || empty($posted['txnid'])
                || empty($posted['amount'])
                || empty($posted['firstname'])
                || empty($posted['email'])
                || empty($posted['phone'])
                || empty($posted['productinfo'])
                || empty($posted['surl'])
                || empty($posted['furl'])
                || empty($posted['service_provider'])
            ) {
                $formError = 1;
            } else {
                //                $posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
                $hashVarsSeq = explode('|', $hashSequence);
                $hash_string = '';
                foreach ($hashVarsSeq as $hash_var) {
                    $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                    $hash_string .= '|';
                }

                $hash_string .= $SALT;


                $hash = strtolower(hash('sha512', $hash_string));
                $action = $PAYU_BASE_URL.'/_payment';

            }
        } elseif (!empty($posted['hash'])) {
            $hash = $posted['hash'];
            $action = $PAYU_BASE_URL.'/_payment';

        }

        return view('payumoney.pay',
            compact('hash', 'action', 'MERCHANT_KEY', 'formError', 'txnid', 'posted', 'SALT'));
    }
}
