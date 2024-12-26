<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rso;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $managerId =  Rso::where('dd_house_id', $request->id)->pluck('manager')->unique();
        $managers = User::whereIn('id', $managerId)->get();

        return response()->json($managers);
    }
}
