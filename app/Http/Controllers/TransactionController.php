<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\RunningNumberService;
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
        $cash_wallet = Wallet::where('user_id', Auth::id())
            ->where('type', 'cash_wallet')
            ->first();
        $amount = $request->amount;

        Transaction::create([
            'user_id' => Auth::user()->id,
            'category' => 'wallet',
            'transaction_type' => 'deposit',
            'txn_hash' => $request->txid,
            'amount' => $amount,
            'status' => 'processing',
            'to_wallet_id' => $cash_wallet->id,
            'transaction_number' => RunningNumberService::getID('transaction'),
            'to_wallet_address' => 'Tsrafcasyas751t2txsaf67ast76',
            'transaction_charges' => 0,
            'transaction_amount' => $amount,
            'old_wallet_amount' => $cash_wallet->balance,
        ]);

        return redirect()->route('dashboard')
            ->with('title', trans('public.deposit_success'))
            ->with('success', trans('public.deposit_success_desc'))
            ->with('alertButton', trans('public.back_to_dashboard'));
    }
}
