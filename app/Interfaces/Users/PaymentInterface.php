<?php 
namespace App\Interfaces\Users;

interface PaymentInterface 
{
    public function getSubscription();
    public function getUserSubscription();
    public function getUserActiveSubscription();
    public function InitiatePayment($request);
    public function ProcessFlutterPayment($request);

}