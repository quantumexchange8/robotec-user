<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\SettingWalletAddress;
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
        $cash_wallet = Wallet::where('user_id', Auth::id())
            ->where('type', 'cash_wallet')
            ->first();

        $balance = $cash_wallet->balance;
        if ($balance >= 250) {
            // $balance = $balance - 250;
            // dd($balance);

            // $cash_wallet->save();

            // add transaction history (purchase_robotec)

            return back()
                ->with('title', trans('public.purchase_robotec_success'))
                ->with('success', trans('public.purchase_robotec_success_desc') )
                ->with('alertButton', trans('public.alright'));
        }

        return to_route('transaction.deposit')
            ->with('title', trans('public.insufficient_balance'))
            ->with('warning', trans('public.insufficient_balance_desc') )
            ->with('alertButton', trans('public.deposit'));
    }

    public function addFund(Request $request)
    {
        $request = $request->validate([
            'wallet' => ['required'],
            'amount' => ['required', 'numeric']
        ]);

        // if fund in, add fund. if top up capital, top up
        // add transaction history (fund_in // top_up_capital)

        // return back with toast
        return back();
    }

    public function transfer() {
        // add balance into commission wallet
        // add transaction history
        
        // return back with toast
        return back();
    }

    public function deposit()
    {
        $wallet_addresses = SettingWalletAddress::all()->pluck('wallet_address')->shuffle();
        return Inertia::render('Dashboard/Deposit', ['wallet_addresses' => $wallet_addresses]);
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
            'to_wallet_id' => $cash_wallet->id,
            'transaction_number' => RunningNumberService::getID('transaction'),
            'to_wallet_address' => $request->to_wallet_address,
            'txn_hash' => $request->txid,
            'amount' => $amount,
            'transaction_charges' => 0,
            'transaction_amount' => $amount,
            'old_wallet_amount' => $cash_wallet->balance,
            'status' => 'processing',
        ]);

        return redirect()->route('dashboard')
            ->with('title', trans('public.deposit_success'))
            ->with('success', trans('public.deposit_success_desc'))
            ->with('alertButton', trans('public.back_to_dashboard'));
    }
}
