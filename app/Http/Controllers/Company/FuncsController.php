<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanySize;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FuncsController extends Controller
{
    //

    public function Index(Request $request){
        $query = Company::query();
        $industries = Industry::query()->get();
        if($request->input('search')){
            $query->where(function($query) use ($request){
                $query->where('name', 'LIKE', "%$request->search%");
                $query->orWhere('country', 'LIKE', "%$request->search%");
                $query->orWhere('city', 'LIKE', "%$request->search%");
          
            });
        }
        if($request->input('filter')){
        $filter = strtolower($request->input('filter'));
        $filter = explode('_',$filter);
        // dd($filter);
        switch($filter[0]){
            case 'industry';
            $query->where('industry_id', $filter[1]);
            break;

            case 'size':
            $query->where('company_size_id', $filter[1]);
            break;
        }
        }   

        if($request->input('sort')){
            $sort = strtolower($request->input('sort'));
            switch($sort)
            {
                case "latest":
                    $query->orderBy('created_at', 'DESC');
                    break;
                case "oldest":
                    $query->orderBy('created_at', 'ASC');
            }
        }

        return response()->json([
            'status' => Response::HTTP_FOUND,
            'data' => [
                'company' => $query->get(),
                'industry' => $industries,
                'company_size' => CompanySize::latest()->get()
            ]
        ]);
    }


    public function CompanyDetails($company_id){
        return response()->json([
            'status' => Response::HTTP_FOUND,
            'data' => [
                'company' => Company::where('id', $company_id)->first(),
                'industry' => Industry::query()->get(),
                'company_size' => CompanySize::latest()->get()
            ]
        ]);

    }
}
