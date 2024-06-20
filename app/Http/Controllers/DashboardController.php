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
        $haveTradingAcc = !empty(Auth::user()->trading_account);

        $pamm = Setting::where('slug', 'pamm-return')->whereDate('updated_at', date("Y-m-d"))->first();
        if ($pamm) {
            $pamm = (double)$pamm->value;
        } else {
            $pamm = 0;
        }

        $autoTrades = AutoTrading::where(['user_id' => Auth::id()])->get();
        // $cumulativePamm = 0;
        // $cumulativeEarnings = 0;
        // foreach ($autoTrades as $autoTrade) {
        //     $histories = SettingHistory::whereDate('created_at', '>', $autoTrade->created_at)->get();
        //     $total = $histories->sum('setting_new_value');
        //     $cumulativePamm += $total;
        //     $cumulativeEarnings += $autoTrade->investment_amount * $total / 100;
        // }
        $data = array(
            array(
                'id' => 1,
                'name' => 'John Doe',
                'matured_at' => 30,
                'gender' => 'Male',
                'cumulative_pamm_return' => 2.1,
                'cumulative_amount' => 50,
                'investment_amount' => 250,
                'created_at' => '2023-01-15 10:30:00',
                'updated_at' => '2023-02-20 15:45:00'
            ),
            array(
                'id' => 2,
                'name' => 'Jane Smith',
                'matured_at' => 25,
                'gender' => 'Female',
                'cumulative_pamm_return' => 2.6,
                'cumulative_amount' => 25,
                'investment_amount' => 250,
                'created_at' => '2023-02-10 08:15:00',
                'updated_at' => '2023-03-18 11:20:00'
            ),
            array(
                'id' => 3,
                'name' => 'Michael Johnson',
                'matured_at' => 0,
                'gender' => 'Male',
                'cumulative_pamm_return' => 1.5,
                'cumulative_amount' => 34,
                'investment_amount' => 500,
                'created_at' => '2023-03-05 14:00:00',
                'updated_at' => '2023-04-22 09:10:00'
            ),
            array(
                'id' => 4,
                'name' => 'Emily Davis',
                'matured_at' => 28,
                'gender' => 'Female',
                'cumulative_pamm_return' => 1.4,
                'cumulative_amount' => 41,
                'investment_amount' => 500,
                'created_at' => '2023-04-20 12:45:00',
                'updated_at' => '2023-05-30 17:55:00'
            ),
            array(
                'id' => 5,
                'name' => 'David Brown',
                'matured_at' => 0,
                'gender' => 'Male',
                'cumulative_pamm_return' => 1.9,
                'cumulative_amount' => 33,
                'investment_amount' => 250,
                'created_at' => '2023-05-15 09:00:00',
                'updated_at' => '2023-06-25 14:30:00'
            )
        );
        $autoTrades = json_decode(json_encode($data));
        return Inertia::render('Dashboard/Dashboard', [
            'walletIds' => $walletIds,
            'robotecTransaction' => (bool)$robotecTransaction,
            'todayPamm' => $pamm,
            'autoTrades' => $autoTrades,
            'haveTradingAcc' => $haveTradingAcc,
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
