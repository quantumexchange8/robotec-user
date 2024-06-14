<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\SettingWalletAddress;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Notifications\DepositRequestNotification;
use App\Services\RunningNumberService;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
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
        $user = Auth::user();
        $cash_wallet = Wallet::where('user_id', $user->id)
            ->where('type', 'cash_wallet')
            ->first();
        $amount = $request->amount;

        $transaction = Transaction::create([
            'user_id' => $user->id,
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

        Notification::route('mail', 'payment@currenttech.pro')
            ->notify(new DepositRequestNotification($transaction, $user));

        return redirect()->route('dashboard')
            ->with('title', trans('public.deposit_success'))
            ->with('success', trans('public.deposit_success_desc'))
            ->with('alertButton', trans('public.back_to_dashboard'));
    }

    public function deposit_approval($token)
    {
        $transactions = Transaction::with('user')
            ->where('transaction_type', 'deposit')
            ->latest()
            ->get();

        foreach ($transactions as $transaction) {
            $hashed_token = md5($transaction->user->email . $transaction->transaction_number);

            if ($token == $hashed_token) {
                return Inertia::render('DepositApproval', [
                    'transaction' => $transaction,
                    'user_profile_photo' => $transaction->user->getFirstMediaUrl('profile_photo')
                ]);
            }
        }

        // Handle case when no payment matches the token
        return '';
    }

    public function depositRequestApproval(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required'],
            'remarks' => ['required']
        ])->setAttributeNames([
            'status' => trans('public.status'),
            'remarks' => trans('public.remarks')
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $status = $request->status == 'approve' ? 'success' : 'failed';
            $transaction = Transaction::find($request->transaction_id);
            $transaction->update([
                'status' => $status,
                'remarks' => $request->remarks,
                'approved_at' => now(),
                'handle_by' => 1,
            ]);

            if ($transaction->status == 'success') {
                $wallet = Wallet::find($transaction->to_wallet_id);
                $wallet->balance += $transaction->transaction_amount;
                $wallet->save();

                $transaction->new_wallet_amount = $wallet->balance;
                $transaction->save();

                $title = trans('public.approve_deposit');
            } else {
                $transaction->new_wallet_amount = $transaction->old_wallet_amount;
                $transaction->save();

                $title = trans('public.reject_deposit');
            }

            return redirect()->back()
                ->with('title', $title)
                ->with('success', trans('public.deposit_approval_return_message', ['transaction_number' => $transaction->transaction_number, 'status' => trans('public.' . $transaction->status)]));
        }
    }
}
