<?php

namespace App\Http\Controllers;

use App\Http\Resources\DdHouseResource;
use App\Models\DdHouse;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class DdHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        $query = DdHouse::query();

        $houses = $query->search($request->search)
            ->latest()
            ->paginate(5)
            ->through( fn($house) => [
                'id' => $house->id,
                'name' => $house->name,
                'code' => $house->code,
                'email' => $house->email,
                'status' => $house->status,
                'created' => Carbon::parse($house->created_at)->toFormattedDayDateString(),
                'lastUpdate' => Carbon::parse($house->updated_at)->diffForHumans(),
                'updated' => Carbon::parse($house->updated_at)->toFormattedDayDateString(),
            ])
            ->withQueryString();

        return Inertia::render('DdHouse/Index', [
            'houses' => $houses,
            'searchTerm' => $request->search,
            'status' => session('msg'),
        ]);
//        return inertia('DdHouse/Index', [
//            'ddHouses' => DdHouseResource::collection($q->search($request->search)
//                ->latest()
//                ->paginate(5)
//                ->withQueryString()),
//
//            'searchTerm' => $request->search,
//            'status' => session('msg'),
//        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('DdHouse/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'code'              => ['required'],
            'name'              => ['required','string'],
            'cluster'           => ['nullable','string'],
            'region'            => ['nullable','string'],
            'district'          => ['nullable','string'],
            'thana'             => ['nullable','string'],
            'email'             => ['nullable','email','lowercase','max:255'],
            'address'           => ['nullable'],
            'proprietor_name'   => ['nullable','string'],
            'contact_number'    => ['nullable','numeric','digits:11','unique:dd_houses'],
            'poc_name'          => ['nullable','string'],
            'poc_number'        => ['nullable','numeric','digits:11','unique:dd_houses'],
            'lifting_date'      => ['nullable','date'],
            'remarks'           => ['nullable'],
        ]);

        if (DdHouse::create($attributes))
        {
            return to_route('ddHouse.index')->with('msg', 'New dd house created successfully.');
        }

        return to_route('ddHouse.index')->with('msg', 'DD House not created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DdHouse $ddHouse): Response|ResponseFactory
    {
        $ddHouse->lifting_date = Carbon::parse($ddHouse->lifting_date)->toFormattedDayDateString();
        $ddHouse->created = $ddHouse->created_at == null ? '' : Carbon::parse($ddHouse->created_at)->toDayDateTimeString();
        $ddHouse->updated = $ddHouse->updated_at == null ? '' : Carbon::parse($ddHouse->updated_at)->toDayDateTimeString();
        $ddHouse->disabled = $ddHouse->disabled_at == null ? '' : Carbon::parse($ddHouse->disabled_at)->toDayDateTimeString();

        return inertia('DdHouse/Show', [
            'ddHouse' => $ddHouse
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DdHouse $ddHouse): Response|ResponseFactory
    {
        return inertia('DdHouse/Edit', ['ddHouse' => $ddHouse]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DdHouse $ddHouse): RedirectResponse
    {
        $attributes = $request->validate([
            'code'              => ['required'],
            'name'              => ['required','string'],
            'cluster'           => ['nullable','string'],
            'region'            => ['nullable','string'],
            'district'          => ['nullable','string'],
            'thana'             => ['nullable','string'],
            'email'             => ['nullable','email','lowercase','max:255','unique:dd_houses,email'.$ddHouse->id],
            'address'           => ['nullable'],
            'proprietor_name'   => ['nullable','string'],
            'contact_number'    => ['nullable','numeric','digits:11','unique:dd_houses,contact_number'.$ddHouse->id],
            'poc_name'          => ['nullable','string'],
            'poc_number'        => ['nullable','numeric','digits:11','unique:dd_houses,poc_number'.$ddHouse->id],
            'lifting_date'      => ['nullable','date'],
            'remarks'           => ['nullable'],
            'disabled_at'       => ['nullable'],
        ]);

        if ($request->status == 0)
        {
            $attributes['disabled_at'] = now();
            $attributes['status'] = 0;
        }elseif ($request->status == 1)
        {
            $attributes['disabled_at'] = null;
            $attributes['status'] = 1;
        }

        if ($ddHouse->update($attributes))
        {
            return to_route('ddHouse.index')->with('msg', 'Information updated successfully.');
        }

        return to_route('ddHouse.index')->with('msg', 'Information not updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DdHouse $ddHouse): RedirectResponse
    {
        $ddHouse->delete();

        return to_route('ddHouse.index')->with('msg', 'DD house deleted successfully.');
    }
}
