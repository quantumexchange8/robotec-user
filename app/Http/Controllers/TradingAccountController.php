<?php

namespace App\Http\Controllers;

use App\Services\CTraderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            (new CTraderService)->createUser($user,  $mainPassword, $investorPassword, 'STANDARD.t', 500, 1, null, null, '');
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

        // if fund in, add fund. if top up capital, top up

        // add transaction history (fund_in // top_up_capital)

        return back()->with('toast', [
            'title' => trans('public.fund_in_success'),
            'message' => trans('public.fund_in_success_desc'),
            'type' => 'success',
        ]);
    }

    public function startAutoTrade()
    {
        // auto trade

        return back()->with('toast', [
            'title' => trans('public.auto_trading_started'),
            'message' => trans('public.auto_trading_started_desc'),
            'type' => 'success'
        ]);
    }

    public function transfer()
    {
        // add balance into commission wallet
        // add transaction history

        // return back with toast
        return back()->with('toast', [
            'title' => trans('public.transfer_success'),
            'message' => trans('public.transfer_success_desc'),
            'type' => 'success'
        ]);
    }
}
