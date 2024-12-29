<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Interfaces\Users\PaymentInterface;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //
protected $subscription;
public function __construct(PaymentInterface $subscription)
{
    $this->subscription = $subscription;
    
}

    public function getSubscription()
    {
       $subscription = $this->subscription->getSubscription();
       return response()->json(['data' => $subscription], 200);  
    }


    public function getUserSubscription()
    {
        $sub = $this->subscription->getUserSubscription();
        return response()->json(['data' => $sub], 200);  
    }

    public function InitiatePayment(PaymentRequest $request)
    {
       return $this->subscription->InitiatePayment($request);
    }

    public function handleFlutterCallback(Request $request)
    {
        try{
           $res = $this->subscription->ProcessFlutterPayment($request);
        return redirect(route('users.orders'));
        }catch(\Exception $e)
        {
            return $e;
            
        }

    }
}
