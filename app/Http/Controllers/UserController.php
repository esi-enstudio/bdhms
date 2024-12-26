<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        $query = User::query();

        return inertia('User/Index', [
            'users' => $query->search($request->search)
            ->latest()
            ->paginate(5)
            ->onEachSide(0)
            ->withQueryString(),

            'searchTerm' => $request->search,
            'status' => session('msg'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation
        $attributes = $request->validate([
            'avatar'    => ['nullable','file','max:1000','mimes:jpeg,jpg,png'],
            'name'      => ['required','max:150'],
            'role'      => ['required'],
            'email'     => ['required','lowercase','max:255','unique:users,email'],
            'phone'     => ['required','numeric','digits:11','unique:users,phone'],
            'password'  => ['required','min:8','confirmed'],
            'remarks'   => ['nullable'],
        ]);

        if ($request->hasFile('avatar'))
        {
            $attributes['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        // Create Use
        $user = User::create($attributes);

        event(new Registered($user));

        // Redirect
        return to_route('user.index')->with('msg', 'New user ['.$user['name'].'] was created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response|ResponseFactory
    {
        $user->created = Carbon::parse($user->created_at)->toDayDateTimeString();
        $user->updated = Carbon::parse($user->updated_at)->toDayDateTimeString();
        $user->update = Carbon::parse($user->updated_at)->diffForHumans();
        $user->email_verified = Carbon::parse($user->email_verified_at)->toFormattedDayDateString();
        $user->disabled = $user->disabled_at == null ? '' : Carbon::parse($user->disabled_at)->toDayDateTimeString();
        $user->remember = $user->remember_token == null ? 'No' : 'Yes';

        return inertia('User/Show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): Response|ResponseFactory
    {
        return inertia('User/Edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // Validation
        $attributes = $request->validate([
            'avatar'    => ['nullable','file','max:1000','mimes:jpeg,jpg,png'],
            'name'      => ['required','max:150'],
            'role'      => ['required'],
            'email'     => ['required','lowercase','max:255',Rule::unique('users')->ignore($user->id)],
            'phone'     => ['required','numeric','digits:11',Rule::unique('users')->ignore($user->id)],
            'remarks'   => ['nullable'],
            'status'    => ['required'],
        ]);

        if ($request->hasFile('avatar'))
        {
            if ($user->avatar)
            {
                Storage::disk('public')->delete($user->avatar);
            }

            $attributes['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }else{
            $attributes['avatar'] = $user->avatar;
        }

        // Update User
        $user->update($attributes);

        // Redirect
        return to_route('user.index')->with('msg', 'User ['.$user['name'].'] was updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->avatar)
        {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return to_route('user.index')->with('msg', 'User deleted successfully.');
    }
}
