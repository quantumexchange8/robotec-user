<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function withdrawal()
    {
        return Inertia::render('Withdrawal/Withdrawal');
    }

    public function purchaseItem()
    {
        return back()
            ->with('title', "Purchase Robotec Successful!")
            ->with('success', "Fantastic! You've successfully finished Step 1 and unlocked your unique QR code for inviting friends. Keep going to unlock even more benefits and rewards! 🌟")
            ->with('alertButton', 'Alright!');
    }
}
