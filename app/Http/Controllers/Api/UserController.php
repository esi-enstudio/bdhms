<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rso;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function fetchUsers(Request $request): JsonResponse
    {
        $query = User::query();

        // Apply search filter
        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('role', 'LIKE', "%{$search}%");
        }

        // Sorting
        if ($request->has('sortBy') && $request->has('sortOrder')) {
            $query->orderBy($request->input('sortBy'), $request->input('sortOrder'));
        }

        // Pagination
        $itemsPerPage = $request->input('itemsPerPage', 5);
        $page = $request->input('page', 1);

        $users = $query->paginate($itemsPerPage, ['*'], 'page', $page);

        return response()->json([
            'items' => $users->items(),
            'total' => $users->total(),
        ]);
    }
}
