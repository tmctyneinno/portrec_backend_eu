<?php

namespace App\Http\Controllers\User;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PortolioController extends BaseController
{
    use UserTrait;

    public function portfolio(PortfolioRequest $request)
    {
        $id = $this->userID()->id;
        $validate = $request->validated;
        $validate['user_id'] = $id;
        $portfolio = Portfolio::create($validate);

        return $this->successMessage($portfolio, "");
    }

    public function deletePortfolio($id)
    {
        $user_id = $this->userID()->id;
        Portfolio::where(['user_id' => $user_id, "id" => $id]);
        return $this->successMessage("", "", 204);
    }

    public function getPortfolio()
    {
        $id = $this->userID()->id;
        $portfolio = Portfolio::with("images")->where("user_id", $id);
        return $this->successMessage($portfolio);
    }

    public function uploadProjectImage(Request $request)
    {
        $userId = $this->userID()->id;
        $resp = FileUpload::uploadFile($request->file("image", "portfolio"));

        if ($resp instanceof Response) return $resp;

        $portfolio = PortfolioImage::create([
            "image_url" => $resp,
            "portfolio_id" => $request->portfolio_id,
            "user_id" => $userId
        ]);

        return $this->successMessage($portfolio, "");
    }

    public function updatePortfolio(PortfolioRequest $request)
    {
        $id = $this->userID()->id;
        $validate = $request->validated;
        $portfolio = Portfolio::where("user_id", $id)->where("id", $id)->update($validate);

        return $this->successMessage($portfolio, "");
    }

    public function deletePortfolioImage($id)
    {
        PortfolioImage::where("id", $id)->delete();
        return $this->successMessage("", "", 204);
    }
}
