<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RetailerResource;
use App\Models\Retailer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RetailerController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $retailers =  Retailer::where([
            ['dd_house_id', $request->id],
            ['enabled', 1]
        ])->get();

        return response()->json(RetailerResource::collection($retailers));
    }
}
