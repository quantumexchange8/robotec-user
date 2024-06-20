<?php

namespace App\Http\Controllers;

use App\Models\AutoTrading;
use App\Models\Setting;
use App\Models\SettingHistory;
use App\Models\Transaction;
use App\Models\Wallet;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $walletIds = Wallet::where('user_id', Auth::id())->pluck('id','type');
        $robotecTransaction = Transaction::where('user_id', Auth::id())->where('transaction_type', 'purchase_robotec')->first();
        $pamm = Setting::where('slug', 'pamm-return')->first();

        $auto_trades = AutoTrading::where('user_id', Auth::id())->get(); // need to filter status

        $cumulative_pamm = 0;
        $cumulative_earnings = 0;
        foreach ($auto_trades as $auto_trade) {
            $histories = SettingHistory::whereDate('created_at', '>', $auto_trade->created_at)->get();
            $total = $histories->sum('setting_new_value');
            $cumulative_pamm += $total;
            $cumulative_earnings += $auto_trade->investment_amount * $total / 100;
        }

        return Inertia::render('Dashboard/Dashboard', [
            'walletIds' => $walletIds,
            'robotecTransaction' => (bool)$robotecTransaction,
            'todayPamm' => $pamm,
            'cumulativePamm' => $cumulative_pamm,
            'cumulativeEarnings' => $cumulative_earnings,
            'autoTrades' => $auto_trades,
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
        return Auth::user()->direct_clients->count();
    }

    public function getTransactions($id)
    {
        $transactions = Transaction::where('from_wallet_id', $id)->orWhere('to_wallet_id', $id)->orderBy('created_at', 'desc')->get();
        $transactions = $transactions->where('status', 'success');

        return response()->json($transactions);
    }

    public function getDirectClients()
    {
        return response()->json(Auth::user()->direct_clients);
    }
}
