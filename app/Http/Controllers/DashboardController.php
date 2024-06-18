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

        return Inertia::render('Dashboard/Dashboard', [
            'walletIds' => $walletIds
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
        $transactions = Transaction::where('from_wallet_id', $id)->orWhere('to_wallet_id', $id)->where('status', 'Success')->orderBy('created_at', 'desc')->get();

        return response()->json($transactions);
    }

    public function getDirectClients()
    {
        return response()->json(Auth::user()->direct_clients);
    }
}
