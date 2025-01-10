<?php 
namespace App\Services\Users;

use App\Http\Middleware\UserSubcription;
use App\Interfaces\Users\PaymentInterface;
use App\Models\CountryCurrency;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;

class PaymentService extends baseFuncs implements PaymentInterface 
{

    public function getSubscription()
    {
     $sub = Subscription::get();
     return $sub->load('subcriptionData');
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
        try{

            $plans = Subscription::where('id', $request->subscription_id)->first();
            $userData =   getUserLocationData();
            $currency = CountryCurrency::where('country', $userData['country'])->first();
            $txRef = 'prtc' . time();
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
            return $res;
            if($res['data'])
            {
                $request = (array)$request->all();
                $request['trans_id'] =  $txRef;
                $request['currency'] = $currency->currency;
                parent::createSubscription($request);
            return $res['data'];
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function ProcessFlutterPayment($request)
    {
        $res =  parent::flutterwaveVerify($request['transaction_id']);
        $Subscription = UserSubscription::where(['trans_id' => $res['data']['tx_ref']])->first();
        if ($res['status'] == 'success') {
            $dates = Carbon::now();
            $Subscription->update([
                'payment_ref' => $res['data']['flw_ref'],
                'is_paid' => 1,
                'payment_ref' => $res['data']['flw_ref'],
                'card_info' => $res['data']['card']['first_6digits'].'*******'.$res['data']['card']['last_4digits'],
                'status' => 1,
                'next_billing' =>  $Subscription->end_date,
                'start_date' => $dates->toDateString(),
            ]);
            $user = User::where('id', 1)->first();
            $user->update(['is_subscribed' => 1]);
            $this->storePaymentInfo($Subscription,$res['data']['flw_ref'], 'Flutterwave');
            $this->sendPaymentEmail($Subscription, $res, $user);
        return $Subscription;
        }
        return false;
    }

}