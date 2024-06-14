<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\SettingWalletAddress;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Services\RunningNumberService;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function withdrawal()
    {
        $commission_wallet = Wallet::where('user_id', Auth::id())
            ->where('type', 'commission_wallet')
            ->first();
        
        return Inertia::render('Withdrawal/Withdrawal', ['commissionWallet' => $commission_wallet]);
    }

    public function storeWithdrawal(Request $request)
    {
        $rule = ['amount' => ['required', 'numeric', 'min:250']];
        $attribute = ['amount' => trans('public.amount')];

        $validator = Validator::make($request->all(), $rule);
        $validator->setAttributeNames($attribute);
        $validator->validate();

        $user_id = Auth::id();
        $user = User::find($user_id);
        $commission_wallet = $user->wallets->where('type', 'commission_wallet')->first();

        if($request->amount > $commission_wallet->balance) {
            return back()
                ->with('title', trans('public.insufficient_balance'))
                ->with('warning', trans('public.insufficient_balance_desc') )
                ->with('alertButton', trans('public.alright'));
        }

        Transaction::create([
            'user_id' => $user_id,
            'category' => 'wallet',
            'transaction_type' => 'withdrawal',
            'from_wallet_id' => $commission_wallet->id,
            'transaction_number' => RunningNumberService::getID('transaction'),
            'to_wallet_address' => $user->usdt_address,
            'amount' => $request->amount,
            'transaction_charges' => $request->charges,
            'transaction_amount' => $request->receivable,
            'old_wallet_amount' => $commission_wallet->balance,
            'status' => 'processing',
        ]);

        return back()
            ->with('title', trans('public.withdrawal_request_submitted'))
            ->with('success', trans('public.withdrawal_request_submitted_desc'))
            ->with('alertButton', trans('public.alright'));
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
