<?php

namespace Database\Seeders;

use App\Models\CountryCurrency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountryCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencyMap = [
            'NG' => 'NGN',  
            'US' => 'USD',  
            'UG' => 'UGX',  
            'KE' => 'KES',  
            'ZA' => 'ZAR',  
            'ZM' => 'ZMW',  
            'GH' => 'GHS',  
            'TZ' => 'TZS',  
            'RW' => 'RWF',  
            'CM' => 'XAF',  
            'SN' => 'XOF',  
            'EG' => 'EGP',  
            'GB' => 'GBP',  
            'FR' => 'EUR', 
            'DE' => 'EUR'   
        ];
         
        foreach($currencyMap as $ss => $value)
        {
            CountryCurrency::create([
                'country' => $ss,
                'currency' => $value
            ]);
        }
    }
}
