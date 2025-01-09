<?php 
namespace App\Interfaces\Recruiter;

interface PaymentInterface 
{
    public function getSubscription();
    public function getRecruiterSubscription();
    public function getRecruiterActiveSubscription();
    public function InitiatePayment($request);
    public function ProcessFlutterPayment($request);

}