<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Services\CTraderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TradingAccountController extends Controller
{
    public function createTradingAccount()
    {
        $user = Auth::user();

        if (App::environment('production')) {
            $mainPassword = Str::random(8);
            $investorPassword = Str::random(8);
            $ctAccount = (new CTraderService)->createUser($user,  $mainPassword, $investorPassword, 'Standard', 500, 1, null, null, '');
            //Mail::to($user->email)->send(new NewMetaAccount($ctAccount['login'], $mainPassword, $investorPassword));
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
}
