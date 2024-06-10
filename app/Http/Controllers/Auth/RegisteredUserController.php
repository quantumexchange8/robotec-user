<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($referral): Response
    {
        return Inertia::render('Auth/Register', [
            'referral_code' => $referral,
        ]);
    }

    public function firstStep(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'full_name' => 'required|string|max:255|unique:' . User::class . ',name',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|unique:' . User::class . ',phone',
        ];

        $attributes = [
            'email' => trans('public.email'),
            'full_name' => trans('public.full_name'),
            'phone_number' => trans('public.phone_number'),
        ];

        $dial_code = $request->dial_code;
        $phone = $request->phone_number;

        // Remove leading '+' from dial code if present
        $dial_code = ltrim($dial_code, '+');

        // Remove leading '+' from phone number if present
        $phone = ltrim($phone, '+');

        // Check if phone number already starts with dial code
        if (!str_starts_with($phone, $dial_code)) {
            // Concatenate dial code and phone number
            $phone = '+' . $dial_code . $phone;
        } else {
            // If phone number already starts with dial code, use the phone number directly
            $phone = '+' . $phone;
        }

        // Merge the modified phone number back into the request
        $request->merge(['phone_number' => $phone]);

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        if ($request->form_step == 0) {
            $validator->validate();
        }

        return to_route('register', ['referral' => $request->referral_code]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'password' => ['required', 'confirmed', Password::min(8)->letters()->symbols()->numbers()->mixedCase()],
        ];

        $attributes = [
            'password' => trans('public.password'),
            'password_confirmation' => trans('public.confirm_password'),
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        $validator->validate();
dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
