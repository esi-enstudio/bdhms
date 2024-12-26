<?php

namespace App\Http\Controllers;

use App\Http\Resources\RsoResource;
use App\Models\DdHouse;
use App\Models\Rso;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class RsoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        return inertia('Rso/Index', [
            'rsos' => RsoResource::collection(Rso::search($request->search)
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
        $hasUserId = Rso::whereNotNull('user_id')->pluck('user_id');

        $users = User::where([
            ['role', 'rso'],
            ['status', 1]
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

        return inertia('Rso/Create', [
            'ddHouses' => DdHouse::all(),
            'users' => $users,
            'zms' => $zms,
            'managers' => $managers,
            'supervisors' => $supervisors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $attr = $request->validate([
            'dd_house_id' => ['required'],
            'user_id' => ['required'],
            'zm' => ['required'],
            'manager' => ['required'],
            'supervisor' => ['required'],
            'osrm_code' => ['nullable'],
            'employee_code' => ['nullable'],
            'code' => ['nullable'],
            'number' => ['required'],
            'pool_number' => ['nullable'],
            'bank_account_name' => ['nullable'],
            'bank_name' => ['nullable'],
            'bank_account_number' => ['nullable'],
            'brunch_name' => ['nullable'],
            'routing_number' => ['nullable'],
            'religion' => ['nullable'],
            'education' => ['nullable'],
            'gender' => ['nullable'],
            'present_address' => ['nullable'],
            'permanent_address' => ['nullable'],
            'father_name' => ['nullable'],
            'mother_name' => ['nullable'],
            'market_type' => ['nullable'],
            'salary' => ['nullable'],
            'category' => ['nullable'],
            'agency_name' => ['nullable'],
            'dob' => ['nullable'],
            'nid' => ['nullable'],
            'division' => ['nullable'],
            'district' => ['nullable'],
            'thana' => ['nullable'],
            'sr_no' => ['nullable'],
            'designation' => ['nullable'],
            'joining_date' => ['nullable'],
            'remarks' => ['nullable'],
        ]);

        Rso::create($attr);

        return to_route('rso.index')->with('msg', 'New rso created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rso $rso): Response|ResponseFactory
    {
        $rso->created = Carbon::parse($rso->created_at)->toDayDateTimeString();
        $rso->updated = Carbon::parse($rso->updated_at)->toDayDateTimeString();
        $rso->dateOfBirth = $rso->dob == null ? 'N/A' : Carbon::parse($rso->dob)->toFormattedDayDateString();
        $rso->join = $rso->joining_date == null ? 'N/A' : Carbon::parse($rso->joining_date)->toDayDateTimeString();
        $rso->resign = $rso->resign_date == null ? 'N/A' : Carbon::parse($rso->resign_date)->toDayDateTimeString();

        return inertia('Rso/Show', ['rso' => $rso]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rso $rso): Response
    {
        $users = User::where([
            ['role', 'rso'],
            ['status', 1]
        ])->get();

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

        return Inertia::render('Rso/Edit', [
            'ddHouses' => DdHouse::all(),
            'users' => $users,
            'zms' => $zms,
            'managers' => $managers,
            'supervisors' => $supervisors,
            'rso' => $rso,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rso $rso): RedirectResponse
    {
        $attr = $request->validate([
            'dd_house_id' => ['required'],
            'user_id' => ['required'],
            'zm' => ['required'],
            'manager' => ['required'],
            'supervisor' => ['required'],
            'osrm_code' => ['nullable'],
            'employee_code' => ['nullable'],
            'code' => ['nullable'],
            'number' => ['required'],
            'pool_number' => ['nullable'],
            'bank_account_name' => ['nullable'],
            'bank_name' => ['nullable'],
            'bank_account_number' => ['nullable'],
            'brunch_name' => ['nullable'],
            'routing_number' => ['nullable'],
            'religion' => ['nullable'],
            'education' => ['nullable'],
            'gender' => ['nullable'],
            'present_address' => ['nullable'],
            'permanent_address' => ['nullable'],
            'father_name' => ['nullable'],
            'mother_name' => ['nullable'],
            'market_type' => ['nullable'],
            'salary' => ['nullable'],
            'category' => ['nullable'],
            'agency_name' => ['nullable'],
            'dob' => ['nullable'],
            'nid' => ['nullable'],
            'division' => ['nullable'],
            'district' => ['nullable'],
            'thana' => ['nullable'],
            'sr_no' => ['nullable'],
            'designation' => ['nullable'],
            'joining_date' => ['nullable'],
            'resign_date' => ['nullable'],
            'remarks' => ['nullable'],
            'status' => ['nullable'],
        ]);

        $rso->update($attr);

        return to_route('rso.index')->with('msg', 'Rso updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rso $rso): RedirectResponse
    {
        $rso->delete();
        return to_route('rso.index')->with('msg', 'Rso deleted successfully.');
    }
}
