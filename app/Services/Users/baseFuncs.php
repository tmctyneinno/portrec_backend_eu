<?php 
namespace App\Services\Users;

use App\Mail\paymentMail;
use App\Models\Billing;
use App\Models\UserSubscription;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class baseFuncs 
{

    public function storePaymentInfo($request, $ref, $channel)
    {
            
        Billing::create([
            'user_id' => 1, 
            'payment_ref' => $ref, 
            'user_subscription_id' => $request->id, 
            'external_ref' => $request['payment_ref'], 
            'status' => 1, 
            'channel' => $channel,
        ]);
    }


    public function sendPaymentEmail($request, $res, $user)
    {
        Mail::to($user->email)->send(new paymentMail([
            'amount' => $request->subscription->amount,
            'payment_ref' => $res['data']['tx_ref'],
            'external_ref' => $res['data']['flw_ref'],
            'topic' => 'Payment for '.$request->subscription->plan_name.' Subscription completed Successfully',
            'name' => $user->name,
            'subscription' => $request->subscription->plan_name,
            'currency' => $request->currency,
            'payment_method'=> 'Online Payment',
            'start_date' => $request->start_date,
            'end_date' => $request->start_date
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
    $dates = Carbon::now();
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
                'payment_ref' => '',
                'end_date' => $dates->copy()->addDays($request['duration'])->toDateString(),
    ]);
}
}