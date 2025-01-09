<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Controller;
use App\Interfaces\Recruiter\PaymentInterface;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;

class SubscriptionController extends Controller
{
    


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


    public function getRecruiterSubscription()
    {
        $sub = $this->subscription->getRecruiterSubscription();
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
        return $res;
        }catch(\Exception $e)
        {
            return $e;
            
        }

    }
}
