<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $homeService;

    // Inject HomeService ke dalam Controller
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function getMapShops()
    {
        // Controller hanya menerima data bersih dari Service dan mengembalikannya ke Flutter
        $data = $this->homeService->getMapShopsData();
        return response()->json($data, 200);
    }
}
