<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanySize;
use App\Models\Industry;
use Illuminate\Http\Request;
use App\Http\Controllers\Users\Job\Trait\JobTrait;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    use JobTrait;

    public function Index(Request $request)
    {

        // dd($request->all());
        $query = Company::query();
        $industries = Industry::query()->get();
        if ($request->input('search')) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->search%");
                $query->orWhere('country', 'LIKE', "%$request->search%");
                $query->orWhere('city', 'LIKE', "%$request->search%");
            });
        }
        if (!empty($request->input('search')) && !empty($request->input('country'))) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->search%");
                $query->Where('country', 'LIKE', "%$request->country%");
            });
        }

        if ($request->get('filter')) {
            $query->whereHas('industries', function ($query) use ($request) {
                $query->where('id', $request->get('filter'));
            });
        }
        if ($request->get('size')) {
            $query->whereHas('sizes', function ($query) use ($request) {
                $query->where('id', $request->get('size'));
            });
        }

        if ($request->input('sort')) {
            $sort = strtolower($request->input('sort'));
            switch ($sort) {
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
                'company' => $query->paginate(10),
                'industry' => $industries,
                'company_size' => CompanySize::latest()->get()
            ]
        ]);
    }

    public function CompanyDetails($company_id)
    {
        return response()->json([
            'status' => Response::HTTP_FOUND,
            'data' => [
                'company' => Company::where('id', $company_id)->with(['recruiter', 'jobs'])->first(),
                'industry' => Industry::query()->get(),
                'company_size' => CompanySize::latest()->get()
            ]
        ]);
    }
}
