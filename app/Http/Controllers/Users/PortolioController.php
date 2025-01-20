<?php

namespace App\Http\Controllers\Users;

use App\Helper\FileUpload;
use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Trait\UserTrait;
use App\Http\Requests\PortfolioRequest;
use App\Models\PortfolioImage;
use App\Models\UserPortfolio;
use Illuminate\Http\Request;
use App\Services\Users\CloudinaryFileUploadService;
use Illuminate\Http\Response;

class PortolioController extends BaseController
{
    use UserTrait;

    public function __construct(
        public readonly CloudinaryFileUploadService $uploadImage
    )
    {
        
    }

    public function Addportfolio(PortfolioRequest $request)
    {
        $portfolio = UserPortfolio::create([
            'user_id' => $this->userID()->id,
            'title' => $request->title,
            'description' => $request->description, 
            'goals' => $request->goals, 
            'achievements' => $request->achievements,
            'project_url' => $request->project_url, 
        ]);
        if($request->file('images')){
           self::AddPortfolioImage($request, $portfolio);
        }
    
        return $this->successMessage($portfolio->load('images'), "");
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

    public function updatePortfolio(Request $request, $id)
    {
        // $jsonImages = [];
        // if($request->file('images')){
        //     foreach($request->file('images') as $image){
        //         $name = $image->getClientOriginalName();
        //     $upl = new CloudinaryFileUploadService;
        //     $images[] = $upl->upload($image, "portfolio", $name);
        //     }
        //     $jsonImages = array_column($images, 1);
        // }
        $userId = $this->userID()->id;; 
        $portfolio = UserPortfolio::where("user_id", $userId)->where("id", $id)->first();
        if(!$portfolio) return response()->json(['error' => 'No Portfolio found']);
        $portfolio->update(
            [
            'user_id' => $this->userID()->id,
            'title' => $request->project_title,
            'description' => $request->description, 
            'goals' => $request->goals, 
            'achievements' => $request->achievements,
            'project_url' => $request->project_url,  
            ]
        );

        return $this->successMessage($portfolio->load('images'), "successful");
    }


    public function AddPortfolioImage(Request $request, $portfolio=null)
    {
        if($portfolio == null){
        $portfolio = UserPortfolio::whereId($request->portfolio_id)->first();
        if(!$portfolio) return response()->json(['error' => 'Portfolio not found']);
        }
        foreach($request->file('images') as $image){
        $name = $image->getClientOriginalName();
        $images = $this->uploadImage->upload($image, "portfolio", $name);
         PortfolioImage::create([
            'user_portfolio_id' => $portfolio?->id,
            'image' => $images[1]
        ]);
    }
    return $portfolio->load('images');
    }

    public function deletePortfolioImage($portfolio_id)
    {
        try{
        $portfolio = PortfolioImage::where('id', $portfolio_id)->first();
        $portfolio->delete();
        return response()->json(['data' => 'Image removed']);
        }catch(\Exception $e)
        {

            return response()->json(['error' => 'Image not found']);
        }

    }

    public function getUserPortfolio()
    {
        $portfolio = UserPortfolio::where('user_id', auth_user()->id)->get();
        return response()->json([
            'data' => $portfolio->load('images')
        ]);
    }

 
}