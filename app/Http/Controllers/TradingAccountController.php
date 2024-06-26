<?php

namespace App\Http\Controllers;

use App\Models\AutoTrading;
use App\Models\TradingAccount;
use App\Models\TradingUser;
use App\Models\Transaction;
use App\Models\User;
use App\Services\CTraderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Services\ChangeTraderBalanceType;
use App\Services\RunningNumberService;

class TradingAccountController extends Controller
{
    public function createTradingAccount()
    {
        $conn = (new CTraderService)->connectionStatus();
        if ($conn['code'] != 0) {
            return back()
                ->with('toast', [
                    'title' => 'Connection Error',
                    'type' => 'error'
                ]);
        }

        $user = Auth::user();

        if (App::environment('production')) {
            $mainPassword = Str::random(8);
            $investorPassword = Str::random(8);
            (new CTraderService)->createUser($user,  $mainPassword, $investorPassword, 'ROBOTEC', 500, 1, null, null, '');
        }

        return back()
            ->with('toast', [
                'title' => trans('public.trading_account_created'),
                'type' => 'success'
            ]);
    }

    public function addFund(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wallet' => ['required'],
            'amount' => ['required', 'numeric']
        ])->setAttributeNames([
            'wallet' => trans('public.select_wallet'),
            'amount' => trans('public.fund_in_amount')
        ]);
        $validator->validate();

        $amount = $request->amount;
        $selectedWallet = Auth::user()->wallets->where('type', $request->wallet)->first();
        if ($selectedWallet->balance < $amount) {
            throw ValidationException::withMessages(['wallet' => trans('public.insufficient_balance')]);
        }

        if ($request->type === 'fund_in') {
            $tradingAcc = Auth::user()->getTradingAccount;
            try {
                $trade = (new CTraderService)->createTrade($tradingAcc->meta_login, $amount, "Wallet To Account", ChangeTraderBalanceType::DEPOSIT);
            } catch (\Throwable $e) {
                if ($e->getMessage() == "Not found") {
                    TradingUser::firstWhere('meta_login', $tradingAcc->meta_login)->update(['acc_status' => 'Inactive']);
                } else {
                    Log::error($e->getMessage());
                }
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }

            $ticket = $trade->getTicket();
            $newBalance = $selectedWallet->balance - $amount;

            Transaction::create([
                'user_id' => Auth::id(),
                'category' => 'trading_account',
                'transaction_type' => 'fund_in',
                'from_wallet_id' => $selectedWallet->id,
                'to_meta_login' => $tradingAcc->meta_login,
                'transaction_number' => RunningNumberService::getID('transaction'),
                'amount' => $amount,
                'transaction_charges' => 0,
                'transaction_amount' => $amount,
                'old_wallet_amount' => $selectedWallet->balance,
                'new_wallet_amount' => $newBalance,
                'status' => 'success',
                'ticket' => $ticket,
            ]);

            $selectedWallet->balance = $newBalance;
            $selectedWallet->save();

            return back()->with('toast', [
                'title' => trans('public.fund_in_success'),
                'message' => trans('public.fund_in_success_desc'),
                'type' => 'success',
            ]);
        }
        //top up capital
    }

    public function startAutoTrade()
    {
        $user = Auth::user();
        $trading_account = TradingAccount::where('user_id', $user->id)->first();
        $transaction = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'fund_in')
            ->latest()
            ->first();

        if ($trading_account->balance >= $transaction->transaction_amount) {
            AutoTrading::create([
               'user_id' => $user->id,
               'meta_login' => $trading_account->meta_login,
               'trading_account_id' => $trading_account->id,
               'transaction_id' => $transaction->id,
               'investment_amount' => $transaction->transaction_amount,
               'period' => 90,
               'status' => 'ongoing',
               'matured_at' => now()->addDays(90)->endOfDay(),
            ]);
        } else {
            return back()
                ->with('title', trans('public.insufficient_balance'))
                ->with('warning', trans('public.insufficient_balance_desc'))
                ->with('alertButton', 'OK');
        }

        return back()->with('toast', [
            'title' => trans('public.auto_trading_started'),
            'message' => trans('public.auto_trading_started_desc'),
            'type' => 'success'
        ]);
    }

    public function transfer(Request $request)
    {
        $tradingAcc = Auth::user()->getTradingAccount;
        (new CTraderService)->getUserInfo(collect($tradingAcc));

        $tradingAcc = Auth::user()->getTradingAccount;
        $autoTrade = AutoTrading::find($request->auto_trade_id);
        $autoTradeCount = AutoTrading::where('user_id', Auth::id())->count();

        $amount = 0;
        if ($autoTradeCount > 1) {
            $amount = $autoTrade->investment_amount + $autoTrade->cumulative_amount;
        } else {
            $amount = $tradingAcc->balance;
        }

        try {
            $trade = (new CTraderService)->createTrade($tradingAcc->meta_login, $amount, "Withdraw pamm return", ChangeTraderBalanceType::WITHDRAW);
        } catch (\Throwable $e) {
            if ($e->getMessage() == "Not found") {
                TradingUser::firstWhere('meta_login', $tradingAcc->meta_login)->update(['acc_status' => 'Inactive']);
            } else {
                Log::error($e->getMessage());
            }
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        $ticket = $trade->getTicket();
        Transaction::create([
            'user_id' => Auth::id(),
            'category' => 'trading_account',
            'transaction_type' => 'withdrawal',
            'from_meta_login' => $tradingAcc->meta_login,
            'ticket' => $ticket,
            'transaction_number' => RunningNumberService::getID('transaction'),
            'amount' => $amount,
            'transaction_charges' => 0,
            'transaction_amount' => $amount,
            'status' => 'success',
        ]);
        
        $autoTrade->status = 'transferred';
        $autoTrade->save();

        $commission_wallet = Auth::user()->wallets->where('type', 'commission_wallet')->first();
        $new_balance = $commission_wallet->balance + ($amount);

        Transaction::create([
            'user_id' => Auth::id(),
            'category' => 'wallet',
            'transaction_type' => 'auto_trade_profit',
            'to_wallet_id' => $commission_wallet->id,
            'from_meta_login' => $tradingAcc->meta_login,
            'transaction_number' => RunningNumberService::getID('transaction'),
            'amount' => $amount,
            'transaction_charges' => 0,
            'transaction_amount' => $amount,
            'old_wallet_amount' => $commission_wallet->balance,
            'new_wallet_amount' => $new_balance,
            'status' => 'success',
        ]);

        $commission_wallet->balance = $new_balance;
        $commission_wallet->save();

        return to_route('dashboard')->with('toast', [
            'title' => trans('public.transfer_success'),
            'message' => trans('public.transfer_success_desc'),
            'type' => 'success'
        ]);
    }
}
