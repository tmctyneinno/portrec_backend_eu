<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Base\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Trait\UserTrait;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortolioController extends BaseController
{
    use UserTrait;

    public function portfolio(Request $request)
    {
        $id = $this->userID()->id;
        $request['user_id'] = $id;
        $portfolio = Portfolio::create($request->all());
        return $this->successMessage($portfolio, "", 204);
    }
}
