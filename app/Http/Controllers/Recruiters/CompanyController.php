<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruiters\Trait\RecruiterTrait;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\CompanySize;
use App\Models\Industry;
use App\Models\RecruiterProfile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{

    use RecruiterTrait;

    public function companyInformation(Request $request)
    {
        $recruiter = $this->RecruiterID();
        $profile = RecruiterProfile::where('recruiter_id', $recruiter->id)->first();
        if (!$profile->company_id) {
            return response()->json('No company found', 204);
        } else {
            $company = Company::with(['recruiters', 'jobs', 'sizes', 'industries'])->find($profile->company_id);
            return response()->json($company, 200);
        }
    }

    // public function createCompany(CompanyRequest $request)
    // {
    //     $recruiter = $this->RecruiterID();
    //     $validatedData = $request->validated();
    //     $newComany = Company::create($validatedData);

    //     # save company_id to recruiter Profile
    //     $recruiterProfile = RecruiterProfile::where('recruiter_id', $recruiter->id)->first();
    //     $recruiterProfile->company_id = $newComany->id;
    //     $recruiterProfile->save();

    //     return response()->json($newComany, 201);
    // }

    public function updateCompany(CompanyRequest $request)
    {
        $recruiter = $this->RecruiterID();
        $profile = RecruiterProfile::where('recruiter_id', $recruiter->id)->first();
        $validatedData = $request->validated();
        $company = Company::find($profile->company_id);
        $company->update($validatedData);

        return response()->json($company, 201);
    }

    public function companyResourses()
    {
        return response()->json([
            'status' => Response::HTTP_FOUND,
            'data' => [
                'industry' => Industry::query()->get(),
                'company_size' => CompanySize::latest()->get()
            ]
        ]);
    }
}
