<?php

namespace App\Http\Controllers\Users;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Trait\UserTrait;
use App\Http\Requests\PortfolioRequest;
use App\Models\UserPortfolio;
use Illuminate\Http\Request;
use App\Services\Users\CloudinaryFileUploadService;
use Illuminate\Http\Response;

class PortolioController extends BaseController
{
    use UserTrait;

    public function portfolio(PortfolioRequest $request)
    {
        $jsonImages = [];
        if($request->file('images')){
            foreach($request->file('images') as $image){
                $name = $image->getClientOriginalName();
            $upl = new CloudinaryFileUploadService;
            $images[] = $upl->upload($image, "portfolio", $name);
            }
            $jsonImages = json_encode(array_column($images, 1));
        }
        $portfolio = UserPortfolio::create([
            'user_id' => $this->userID()->id,
            'project_title' => $request->project_title,
            'project_role' => $request->project_role, 
            'project_task' => $request->project_task, 
            'project_solution' => $request->project_solution,
            'project_url' => $request->project_url, 
            'images' => $jsonImages
        ]);

        return $this->successMessage($portfolio, "");
    }

    public function deletePortfolio($id)
    {
        $user_id = $this->userID()->id;
        $del = UserPortfolio::where([
            ['user_id', '=', $user_id],
            ["id", '=', $id]
        ])->delete();

        return $this->successMessage("", "", 204);
    }

    public function getPortfolio()
    {
        $id = $this->userID()->id;
        $portfolio = UserPortfolio::where("user_id", $id)->get();
        return $this->successMessage($portfolio);
    }

    public function updatePortfolio(PortfolioRequest $request, $id)
    {
        $userId = $this->userID()->id;
        $validate = $request->validated();
        $portfolio = UserPortfolio::where("user_id", $userId)->where("id", $id)->update($validate);

        return $this->successMessage($portfolio, "successful");
    }

 
}