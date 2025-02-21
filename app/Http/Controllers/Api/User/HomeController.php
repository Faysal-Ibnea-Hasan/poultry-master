<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeContentResource;
use App\Interfaces\HomeInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected HomeInterface $homeRepo)
    {

    }

    public function homePageContent()
    {
        $menu = $this->homeRepo->getMenu();
        return response()->json([
            'status' => true,
            'message' => 'Data was found successfully',
            'data' => new HomeContentResource($menu)
        ], 200);
    }
}
