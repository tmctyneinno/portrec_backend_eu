<?php

namespace App\Http\Controllers;

use App\Models\Summit;
use App\Models\SummitRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SummitController extends Controller
{
    //


    public function getSummit()
    {
        $Activesummit = Summit::where('summit_date', '>=', Carbon::now())->get();
        $expired_summit = Summit::where('summit_date', '<=', Carbon::now())->get();

        return response()->json([
            'active' => $Activesummit,
            'expired' => $expired_summit
        ]);
    }

    public function summitDetails($summit)
    {

        $summit = Summit::where('id', $summit)->first();
        $summits = Summit::latest()->get();

        return response()->json([
            'summit' => $summit,
            'summits' => $summits
        ]);

    }


    public function summitDetailsRegistration(Request $request)
    {
      $data =  $request->only(['email', 'name', 'summit_id']);
        SummitRegistration::create($data);
        return response()->json(['data' => $data]);
    }


}
