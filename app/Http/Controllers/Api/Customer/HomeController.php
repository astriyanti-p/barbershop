<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Services\HomeService;

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
        // Controller HANYA menerima data bersih dari Service 
        // dan mengembalikannya ke Flutter dalam bentuk JSON
        $data = $this->homeService->getMapShopsData();

        return response()->json($data, 200);
    }
    public function getPopularStyles() // Nama fungsi tetap sama agar tidak perlu ubah route
    {
        $data = $this->homeService->getPopularServices();
        return response()->json($data);
    }
}
