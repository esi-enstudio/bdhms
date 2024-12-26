<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLiftingRequest;
use App\Http\Resources\DdHouseResource;
use App\Http\Resources\UserResource;
use App\Models\DdHouse;
use App\Models\Lifting;
use App\Models\Product;
use App\Services\AllTimeLiftingAggregationService;
use App\Services\CurrentMonthLiftingAggregationService;
use App\Services\FilteredLiftingAggregationService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class LiftingController extends Controller
{
    protected AllTimeLiftingAggregationService $allTimeLiftingService;
    protected CurrentMonthLiftingAggregationService $currentMonthLiftingService;
    protected FilteredLiftingAggregationService $filteredLiftingService;

    public function __construct(AllTimeLiftingAggregationService $allTimeLiftingService, CurrentMonthLiftingAggregationService $currentMonthLiftingService, FilteredLiftingAggregationService $filteredLiftingService)
    {
        $this->allTimeLiftingService        = $allTimeLiftingService;
        $this->currentMonthLiftingService   = $currentMonthLiftingService;
        $this->filteredLiftingService       = $filteredLiftingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        // Fetch all liftings grouped by house
        $allTimeGroupedData = $this->allTimeLiftingService->getAllTimeGroupedLiftingData();
        $currentMonthGroupedData = $this->currentMonthLiftingService->getCurrentMonthGroupedLiftingData();

        // Filtered bank deposit amount
        $filteredGroupedData = null;
        if ($request->filled('startDate') && $request->filled('endDate')) {
            $filteredGroupedData = $this->filteredLiftingService->getFilteredGroupedLiftingData($request);
        }

        // Start building the query for filtered results
        $query = Lifting::query();

        // Apply date range filter if provided
        if ($request->filled('startDate') && $request->filled('endDate')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->startDate)->startOfDay(),
                Carbon::parse($request->endDate)->endOfDay()
            ]);
        }

        // Get filtered lifting records
        $liftings = $query->latest()
           ->paginate(3)
           ->through(fn($lifting) => [
               'id'        => $lifting->id,
               'house'     => new DdHouseResource($lifting->ddHouse),
               'user'      => new UserResource($lifting->user),
               'products'  => $lifting->products,
               'itopup'    => $lifting->itopup,
               'deposit'   => $lifting->deposit,
               'attempt'   => $lifting->attempt,
               'created'   => Carbon::parse($lifting->created_at)->toDayDateTimeString(),
               'updated'   => Carbon::parse($lifting->updated_at)->toDayDateTimeString(),
           ])
           ->onEachSide(0)
           ->withQueryString();

        // Pass data and filters back to the frontend
        return Inertia::render('Service/Lifting/Index', [
            'liftings'                  => $liftings,
            'products'                  => Product::all(),
            'status'                    => session('msg'),
            'filters'                   => $request->only('startDate', 'endDate'),
            'allTimeGroupedData'        => $allTimeGroupedData,
            'currentMonthGroupedData'   => $currentMonthGroupedData,
            'filteredGroupedData'       => $filteredGroupedData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Service/Lifting/Create', [
            'houses' => DdHouse::all(['id','code','name']),
            'products' => Product::all(),
            'status' => session('msg'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dd_house_id'   => ['required'],
            'products'      => ['required','array'],
            'deposit'       => ['required','numeric','min:1'],
            'itopup'        => ['nullable'],
            'attempt'       => ['required'],
        ],[

        ],[
            'dd_house_id' => 'house'
        ]);

        $validated['itopup'] = round(($validated['deposit'] - array_reduce($validated['products'], function ($carry, $product) {
                    return $carry + ($product['lifting_price'] * $product['quantity']);
                }, 0)) / 0.9625);

        $validated['user_id'] = Auth::id();

        Lifting::create($validated);

        return to_route('lifting.create')->with('msg', 'Lifting data added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lifting $lifting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lifting $lifting): Response
    {
        return Inertia::render('Service/Lifting/Edit', [
            'lifting' => $lifting,
            'houses' => DdHouse::all(),
            'products' => Product::all(), // Pass products for dropdowns
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLiftingRequest $request, Lifting $lifting): RedirectResponse
    {
        $attributes = $request->validated();

        $attributes['itopup'] = round(
            ($attributes['deposit'] - array_reduce($attributes['products'], function ($carry, $product)
                {
                    return $carry + ($product['lifting_price'] * $product['quantity']);
                }, 0)) / 0.9625
        );

        $attributes['user_id'] = Auth::id();

        $lifting->update($attributes);

        return to_route('lifting.index')->with('msg', 'Lifting data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lifting $lifting): RedirectResponse
    {
        $lifting->delete();

        return to_route('lifting.index')->with('msg', 'Lifting data deleted successfully!');
    }
}
