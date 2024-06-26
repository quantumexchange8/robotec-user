<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function storeUsdt(Request $request)
    {
        $rule = ['usdt' => ['required', 'string']];
        $attribute = ['usdt' => trans('public.usdt_address')];

        $validator = Validator::make($request->all(), $rule);
        $validator->setAttributeNames($attribute);
        $validator->validate();

        $user = User::find(Auth::id());
        $user->usdt_address = $request->usdt;
        $user->save();

        return back()->with('toast', [
            'title' => trans('public.usdt_added'),
            'type' => 'success'
        ]);
    }

    public function storePhoto(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('profilePhoto')) {
            $user->clearMediaCollection('profile_photo');
            $user->addMedia($request->profilePhoto)->toMediaCollection('profile_photo');
        }

        return back()->with('toast', [
            'title' => trans('public.profile_photo_uploaded'),
            'type' => 'success'
        ]);
    }
}
