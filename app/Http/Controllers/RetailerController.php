<?php

namespace App\Http\Controllers;

use App\Http\Resources\RetailerResource;
use App\Models\DdHouse;
use App\Models\Retailer;
use App\Models\Rso;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Response;
use Inertia\ResponseFactory;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        return inertia('Retailer/Index', [
            'retailers' => RetailerResource::collection(Retailer::search($request->search)
                ->latest()
                ->paginate(5)
                ->onEachSide(0)
                ->withQueryString()),

            'searchTerm' => $request->search,
            'status' => session('msg'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        $hasUserId = Retailer::whereNotNull('user_id')->pluck('user_id');

        $users = User::where([
            ['role', 'retailer'],
            ['status', 1],
        ])->whereNotIn('id', $hasUserId)->get();

        $zms = User::where([
            ['role', 'zm'],
            ['status', 1],
        ])->get();

        $managers = User::where([
            ['role', 'manager'],
            ['status', 1],
        ])->get();

        $supervisors = User::where([
            ['role', 'supervisor'],
            ['status', 1],
        ])->get();

        $rsos = Rso::where('status', 1)->get();

        return inertia('Retailer/Create', [
            'ddHouses' => DdHouse::all(),
            'users' => $users,
            'zms' => $zms,
            'managers' => $managers,
            'supervisors' => $supervisors,
            'rsos' => $rsos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'dd_house_id' => ['required'],
            'user_id' => ['required'],
            'rso_id' => ['required'],
            'zm' => ['required'],
            'manager' => ['required'],
            'supervisor' => ['required'],
            'code' => ['required','unique:retailers,code'],
            'name' => ['required'],
            'number' => ['required','unique:retailers,number'],
            'type' => ['nullable'],
            'sso' => ['nullable'],
            'service_point' => ['nullable'],
            'category' => ['nullable'],
            'father_name' => ['nullable'],
            'mother_name' => ['nullable'],
            'division' => ['nullable'],
            'district' => ['nullable'],
            'thana' => ['nullable'],
            'address' => ['nullable'],
            'dob' => ['nullable'],
            'nid' => ['nullable','unique:retailers,nid'],
            'lat' => ['nullable'],
            'long' => ['nullable'],
            'description' => ['nullable'],
            'remarks' => ['nullable'],
        ]);

        Retailer::create($attributes);

        return to_route('retailer.index')->with('msg', 'New retailer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Retailer $retailer): Response|ResponseFactory
    {
        $retailer->service_point = Str::upper($retailer->service_point);
        $retailer->dob = Carbon::parse($retailer->dob)->toFormattedDayDateString();

        $retailer->zm = User::firstWhere('id', $retailer->zm);
        $retailer->manager = User::firstWhere('id', $retailer->manager);
        $retailer->supervisor = User::firstWhere('id', $retailer->supervisor);
        $retailer->created = $retailer->created_at ? Carbon::parse($retailer->created_at)->toDayDateTimeString() : '';
        $retailer->updated = $retailer->updated_at ? Carbon::parse($retailer->updated_at)->toDayDateTimeString() : '';
        $retailer->disabled = $retailer->disabled_at ? Carbon::parse($retailer->disabled_at)->toDayDateTimeString() : '';

        return inertia('Retailer/Show', ['retailer' => $retailer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Retailer $retailer): Response
    {
        return inertia('Retailer/Edit', [
            'retailer' => $retailer,
            'user' => User::firstWhere([
                ['role', 'retailer'],
                ['status', 1],
                ['id', $retailer->user_id],
            ])->only('id','name'),

            'house' => DdHouse::firstWhere([
                ['id', $retailer->dd_house_id],
                ['status', 1],
            ])->only('id','code','name'),

            'zm' => User::firstWhere([
                ['id', $retailer->zm],
                ['status', 1]
            ])->only('id','name'),

            'manager' => User::firstWhere([
                ['id', $retailer->manager],
                ['status', 1]
            ])->only('id','name'),

            'supervisor' => User::firstWhere([
                ['id', $retailer->supervisor],
                ['status', 1]
            ])->only('id','name'),

            'rso' => Rso::firstWhere([
                ['id', $retailer->rso_id],
                ['status', 1]
            ])->only('id','number','user'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Retailer $retailer): RedirectResponse
    {
        $attributes = $request->validate([
            'dd_house_id' => ['required'],
            'user_id' => ['required'],
            'rso_id' => ['required'],
            'zm' => ['required'],
            'manager' => ['required'],
            'supervisor' => ['required'],
            'code' => ['required', Rule::unique('retailers','code')->ignore($retailer->id)],
            'name' => ['required'],
            'number' => ['required', Rule::unique('retailers','number')->ignore($retailer->id)],
            'type' => ['nullable'],
            'enabled' => ['nullable'],
            'sso' => ['nullable'],
            'service_point' => ['nullable'],
            'category' => ['nullable'],
            'father_name' => ['nullable'],
            'mother_name' => ['nullable'],
            'division' => ['nullable'],
            'district' => ['nullable'],
            'thana' => ['nullable'],
            'address' => ['nullable'],
            'dob' => ['nullable'],
            'nid' => ['nullable', Rule::unique('retailers','nid')->ignore($retailer->id)],
            'lat' => ['nullable'],
            'long' => ['nullable'],
            'description' => ['nullable'],
            'remarks' => ['nullable'],
        ]);

        if ($request->enabled == 0)
        {
            $attributes['disabled_at'] = now();
            $attributes['enabled'] = 0;
        }elseif ($request->enabled == 1)
        {
            $attributes['disabled_at'] = null;
            $attributes['enabled'] = 1;
        }

        $retailer->update($attributes);

        return to_route('retailer.index')->with('msg', 'Retailer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Retailer $retailer): RedirectResponse
    {
        $retailer->delete();
        return to_route('retailer.index')->with('msg', 'Retailer deleted successfully.');
    }
}
