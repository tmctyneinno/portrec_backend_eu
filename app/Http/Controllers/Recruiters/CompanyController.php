<?php

namespace App\Http\Controllers\Recruiters;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruiters\Trait\RecruiterTrait;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\CompanySize;
use App\Models\Industry;
use App\Models\ProfilePicture;
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
            $avatar = ProfilePicture::find($company->image);
            $company['avatar'] =  $avatar?->url ?? null;

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
            'industry' => Industry::query()->get(),
            'company_size' => CompanySize::latest()->get()
        ], 200);
    }




    public function uploadImage(Request $request)
    {
        $recruiter = $this->RecruiterID();
        $folder_path = 'profile_pics';

        $recruiterProfile = RecruiterProfile::where('recruiter_id', $recruiter->id)->first();

        $company = Company::find($recruiterProfile->company_id);

        // delete existing photo
        if ($company->image) {
            $avatar = $company->avatar;
            FileUpload::deleteFileInPath($avatar->folder_path, $avatar->name);
        }

        // upload the new file and URL
        $fileUploaded = FileUpload::uploadFileToPath($request, 'img', $folder_path);
        $ProfilePic = ProfilePicture::updateOrCreate(
            ['id' => $company->image],
            [
                'name' => $fileUploaded['name'],
                'folder_path' => $folder_path,
                'url' => $fileUploaded['url'],
            ]
        );

        // update avatar
        $company->update(["image" => $ProfilePic->id]);

        return response()->json($ProfilePic, 200);
    }
}
