<?php

namespace App\Http\Controllers;

use App\Models\AutoTrading;
use App\Models\Setting;
use App\Models\SettingHistory;
use App\Models\Transaction;
use App\Models\Wallet;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $walletIds = Wallet::where('user_id', Auth::id())->pluck('id','type');
        $robotecTransaction = Transaction::where('user_id', Auth::id())->where('transaction_type', 'purchase_robotec')->first();
        $tradingAcc = Auth::user()->getTradingAccount;

        $pamm = Setting::where('slug', 'pamm-return')->whereDate('updated_at', date("Y-m-d"))->first();

        $autoTradeQuery = AutoTrading::where('user_id', Auth::id());
        $autoTrades = (clone $autoTradeQuery)->whereNotIn('status', ['transferred', 'pending'])->get()->map(function($autoTrade) {
            $now = Carbon::now();
            $autoTrade->countdown = $now->diffInDays($autoTrade->matured_at);

            return $autoTrade;
        });

        return Inertia::render('Dashboard/Dashboard', [
            'walletIds' => $walletIds,
            'robotecTransaction' => (bool)$robotecTransaction,
            'todayPamm' => $pamm ? (double)$pamm->value : 0,
            'autoTrades' => $autoTrades,
            'tradingAcc' => $tradingAcc,
            'autoTradesCount' => (clone $autoTradeQuery)->get()->count(),
            'pendingAutoTrade' => (clone $autoTradeQuery)->where('status', 'pending')->count(),
        ]);
    }

    public function getWallets(Request $request)
    {
        return response()->json([
            'cashWalletBalance' => Wallet::find($request->cash_wallet_id)->balance,
            'commissionWalletBalance' => Wallet::find($request->commission_wallet_id)->balance,
        ]);
    }

    public function getDirectClientsCount()
    {
        $directClient = Auth::user()->getDirectClients;
        $totalClientCount = $directClient->count();
        $step1ClientCount = Transaction::whereIn('user_id', $directClient->pluck('id'))->where('transaction_type', 'purchase_robotec')->count();
        $step2ClientCount = AutoTrading::distinct('user_id')->whereIn('user_id', $directClient->pluck('id'))->pluck('user_id')->count();

        return response()->json([
            'totalCount' => $totalClientCount,
            'step1Count' => $step1ClientCount,
            'step2Count' => $step2ClientCount,
        ]);
    }

    public function getTransactions($id)
    {
        $transactions = Transaction::where('status', 'success')
                        ->where(function($query) use ($id) {
                            $query->where('from_wallet_id', $id)->orWhere('to_wallet_id', $id);
                        })
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response()->json($transactions);
    }

    public function getDirectClients()
    {
        $directClients = Auth::user()->getDirectClients->map(function($directClient) {
            $directClient->progress = '0';

            $step1 = Transaction::where('user_id', $directClient->id)->where('transaction_type', 'purchase_robotec')->count();
            if ($step1 > 0) {
                $directClient->progress = '1';
            }

            $step2 = AutoTrading::where('user_id', $directClient->id)->count();
            if ($step2 > 0) {
                $directClient->progress = '2';
            }

            $directClient->profile_photo = $directClient->getFirstMediaUrl('profile_photo');

            return $directClient;
        });

        return response()->json($directClients);
    }
}
