<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rso;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $supervisorId =  Rso::where('dd_house_id', $request->id)->pluck('supervisor')->unique();
        $supervisors = User::whereIn('id', $supervisorId)->get();

        return response()->json($supervisors);
    }
}
