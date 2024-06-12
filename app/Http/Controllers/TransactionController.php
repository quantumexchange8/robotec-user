<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\Transaction;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function deposit()
    {
        return Inertia::render('Dashboard/Deposit');
    }

    public function storeDeposit(DepositRequest $request)
    {
        Transaction::create([
            'user_id' => Auth::user()->id,
            'transaction_type' => 'deposit',
            'txn_hash' => $request->txid,
            'amount' => $request->amount,
            'status' => 'processing',
            'category' => '',
            'from_wallet_id' => 1,
            'to_wallet_id' => 1,
            'from_meta_login' => 1,
            'to_meta_login' => 1,
            'transaction_number' => '',
            'from_wallet_address' => '',
            'to_wallet_address' => '',
            'transaction_charges' => 1,
            'transaction_amount' => 1,
            'old_wallet_amount' => 1,
            'new_wallet_amount' => 1,
            'comment' => '',
            'remarks' => '',
            'handle_by' => 1,
        ]);

        return redirect()->route('dashboard')            
            ->with('title', trans('public.deposit_success'))
            ->with('success', trans('public.deposit_success_desc'))
            ->with('alertButton', trans('public.back_to_dashboard'));
    }
}
