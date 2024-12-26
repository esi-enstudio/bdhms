<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItopReplaceResource;
use App\Models\ItopReplace;
use App\Models\Retailer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class ItopReplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        return inertia('Service/ItopReplace/Index', [
            'itopReplaces' => ItopReplaceResource::collection(ItopReplace::search($request->search)
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
    public function create(): Response
    {
        return Inertia::render('Service/ItopReplace/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'number'        => ['required','numeric','digits:11'],
            'sim_serial'    => ['required','numeric','digits:18','unique:itop_replaces,sim_serial'],
            'balance'       => ['required','numeric'],
            'reason'        => ['required','max:100'],
            'remarks'       => ['nullable','max:100'],
            'description'   => ['nullable','max:255'],
        ]);

        $attributes['retailer_id'] = Retailer::firstWhere('number', $request->number)->id;
        $attributes['rso_id'] = Retailer::firstWhere('number', $request->number)->rso_id;
        $attributes['supervisor'] = Retailer::firstWhere('number', $request->number)->supervisor;
        $attributes['manager'] = Retailer::firstWhere('number', $request->number)->manager;
        $attributes['zm'] = Retailer::firstWhere('number', $request->number)->zm;
        $attributes['user_id'] = Auth::id();
        $attributes['dd_house_id'] = Retailer::firstWhere('number', $request->number)->dd_house_id;

        ItopReplace::create($attributes);

        return to_route('itopReplace.index')->with('msg', 'Itop replace request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ItopReplace $itopReplace): Response
    {
        $itopReplace->user->role = Str::title($itopReplace->user->role);
        $itopReplace->status = Str::title($itopReplace->status);
        $itopReplace->remarks = Str::title($itopReplace->remarks);
        $itopReplace->created = $itopReplace->created_at ? Carbon::parse($itopReplace->created_at)->toDayDateTimeString() : 'N/A';
        $itopReplace->requested = $itopReplace->requested_at ? Carbon::parse($itopReplace->requested_at)->toDayDateTimeString() : 'N/A';
        $itopReplace->completed = $itopReplace->completed_at ? Carbon::parse($itopReplace->completed_at)->toDayDateTimeString() : 'N/A';

        $itopReplace->zm = User::firstWhere('id', $itopReplace->zm);
        $itopReplace->manager = User::firstWhere('id', $itopReplace->manager);
        $itopReplace->supervisor = User::firstWhere('id', $itopReplace->supervisor);

        return Inertia::render('Service/ItopReplace/Show', [
            'itopReplace' => $itopReplace,
            'replaceHistory' => ItopReplaceResource::collection(ItopReplace::search($request->search)
                ->where('number', $itopReplace->number)
                ->latest()
                ->paginate(5)
                ->onEachSide(0)
                ->withQueryString()),

            'searchTerm' => $request->search,
            'status' => session('msg'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItopReplace $itopReplace): Response
    {
        return Inertia::render('Service/ItopReplace/Edit', [
            'itopReplace' => $itopReplace,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItopReplace $itopReplace): RedirectResponse
    {
        $attributes = $request->validate([
            'number'        => ['required','numeric','digits:11'],
            'sim_serial'    => ['required','numeric','digits:18', Rule::unique('itop_replaces', 'sim_serial')->ignore($itopReplace->id)],
            'balance'       => ['required','numeric'],
            'reason'        => ['required','max:100'],
            'remarks'       => ['nullable','max:100'],
            'status'        => ['nullable'],
            'description'   => ['nullable','max:255'],
        ]);

        $attributes['dd_house_id'] = Retailer::firstWhere('number', $request->number)->dd_house_id;
        $attributes['user_id'] = Auth::id();
        $attributes['zm'] = Retailer::firstWhere('number', $request->number)->zm;
        $attributes['manager'] = Retailer::firstWhere('number', $request->number)->manager;
        $attributes['supervisor'] = Retailer::firstWhere('number', $request->number)->supervisor;
        $attributes['rso_id'] = Retailer::firstWhere('number', $request->number)->rso_id;
        $attributes['retailer_id'] = Retailer::firstWhere('number', $request->number)->id;

        switch ($request->status)
        {
            case 'processing':
                $attributes['requested_at'] = now();
                break;
            case 'complete':
                $attributes['completed_at'] = now();
                break;
        }

        $itopReplace->update($attributes);

        return to_route('itopReplace.index')->with('msg', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItopReplace $itopReplace): RedirectResponse
    {
        $itopReplace->delete();

        return to_route('itopReplace.index')->with('msg', 'Record deleted successfully.');
    }
}
