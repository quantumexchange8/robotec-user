<?php

namespace App\Http\Controllers;

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

        return Inertia::render('Dashboard/Dashboard', [
            'walletIds' => $walletIds,
            'robotecTransaction' => (bool)$robotecTransaction
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
