<?php 
namespace App\Services\Users;

use App\Http\Middleware\UserSubcription;
use App\Interfaces\Users\PaymentInterface;
use App\Models\CountryCurrency;
use App\Models\Subscription;
use App\Models\UserSubscription;

class PaymentService extends baseFuncs implements PaymentInterface 
{

    public function getSubscription()
    {
     return Subscription::get();
    }


    public function getUserSubscription()
    {
        $Subscription = UserSubscription::where('user_id', auth_user())->paginate(10);
        return $Subscription->load('user');
    }

    public function getUserActiveSubscription(){}

    public function InitiatePayment($request){

        // if ($request->payment_method == 'paystack') return $this->initiatePaystackCheckout($request);
        if ($request->payment_method == 'flutterwave')  return $this->initiateFlutterCheckout($request);
    }
    public function verifyPayment(){}


    public function initiateFlutterCheckout($request)
    {
            $plans = Subscription::where('id', $request->subscription_id)->first();
            $userData =   getUserLocationData();
            $currency = CountryCurrency::where('country', $userData['country'])->first();
            $txRef = 'PRT-' . time();
            $data = [
                'tx_ref' =>  $txRef,
                'amount' => isset($currency->exchange_rate) ? $request->amount * $currency->exchange_rate : $request->amount,
                'currency' => $currency->currency ?? 'USD',
                // 'redirect_url' => url('flutter/callback'),
                'redirect_url' => 'https://api.flutterwave.com/v3/payments',
                'customer' => [
                    'email' => auth_user()->email,
                    'name' => auth_user()->first_name . ' ' .auth_user()->first_name,
                    'phonenumber' => auth_user()->phone
                ],
                'customizations' => [
                    'title' => $plans->plan_name .' '.$plans->period.' Subscription',
                    'logo' => 'https://portrec.ng/images/site_logo.png'
                ]
            ];
            $res = parent::getFlutterPaymentLink('https://api.flutterwave.com/v3/payments', $data);
            if($res['data'])
            {
                $request = (array)$request->all();
                $request['trans_id'] =  $txRef;
                $request['currency'] = $currency->currency;
                parent::createSubscription($request);
            return $res['data'];
            }else{
        return false;
            }
    }
    public function ProcessFlutterPayment($request)
    {
        $res =  parent::flutterwaveVerify($request['transaction_id']);
        dd($res);

        $Subscription = UserSubscription::where(['user_id' => auth_user()->id, 'trans_id' =>$request['transaction_id']])->first();
        if ($res['status'] == 'success') {
            $Subscription->update([
                'payment_ref' => $res['data']['flw_ref'],
                'is_paid' => 1,
            ]);
            return $Subscription;
            // $this->storePaymentInfo($order_no, $res['data'], $ref, 'Flutterwave');
            // $this->sendPaymentEmail($request, $order_no, $ref);
        }
        return false;
    }

}