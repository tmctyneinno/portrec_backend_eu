<?php 

namespace App\Services\Recruiter;

use GuzzleHttp\Client;

class Base 
{

    public function __construct(
        public $method, 
        public $url,
        public  $token, 
        public $jsonBody
        )
    {
    $this->method = $method;
    $this->url = $url;
    $this->token = $token;
    $this->jsonBody = $jsonBody;        
    }


    public function SendRequest()
    {
        $client = new Client;
        $res = $client->sendRequest($this->method, $this->url,[
            'headers' => [
                'Authorization' => $this->token,
                'Accept' => 'application/json',
                'Content-Type' =>  'application/json'
              ],
            'data' => json_encode($this->jsonBody)
        ]);
        return $res;
    }
}