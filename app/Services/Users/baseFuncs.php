<?php 
namespace App\Services\Users;

use App\Mail\paymentMail;
use App\Models\Billing;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Mail;

class baseFuncs 
{

    public function storePaymentInfo($request, $ref, $channel)
    {
            
        Billing::create([
            'user_id' => auth_user()->id, 
            'payment_ref' => $ref, 
            'external_ref' => $request['reference'], 
            'status' => 1, 
            'channel' => $channel,
            'amount' => $request['amount']
        ]);
    }


    public function sendPaymentEmail($request, $ref)
    {
        Mail::to(auth_user()->email)->send(new paymentMail([
            'amount' => $request['amount'],
            'payment_ref' => $ref,
            'external_ref' => $request['reference'],
           ]));
    }


    public function getFlutterPaymentLink($url,$jsonBody)
    {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($jsonBody),
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer '.getenv('Flutter_SECRET_KEY'), 
                    'Content-Type: application/json'
                ]
            ]);
            $response = curl_exec($curl);
            // dd( $response);
            $error = curl_error($curl);
            curl_close($curl);
            $res = json_decode($response, true);
            return  $res;
    }

    public function flutterwaveVerify($trnx)
{
    $url = "https://api.flutterwave.com/v3/transactions/{$trnx}/verify";
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer ".getenv('Flutter_SECRET_KEY'), 
            "Content-Type: application/json"
        ]
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    if ($response) {
        $data = json_decode($response, true);
        if (isset($data['status']) && $data['status'] === 'success') {
            return $data;  
        }
        return false;
    }
}

public function createSubscription($request)
{
    return UserSubscription::create([
               'subscription_id' => $request['subscription_id'], 
               'user_id' => auth_user()->id,
                'start_date'=> null,
                'end_date'=> null,
                'status'=> 0,
                'is_paid' => 0,
                'card_info'=> '',
                'next_billing' => '',
                'currency' =>  $request['currency'] ,
                'trans_id' => $request['trans_id'],
                'payment_ref' => ''
    ]);
}
}