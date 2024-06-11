<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::min(8)->letters()->symbols()->numbers()->mixedCase(), 'confirmed'],
        ];

        $attributes = [
            'current_password' => trans('public.current_password'),
            'password' => trans('public.new_password'),
            'password_confirmation' => trans('public.confirm_password'),
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);
        $validator->validate();

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back();
    }
}
