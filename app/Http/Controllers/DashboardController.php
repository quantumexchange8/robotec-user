<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Dashboard');
    }

    public function getWallets()
    {
        $user = Auth::user();

        return response()->json($user->wallets);
    }

    public function getDirectClientsCount()
    {
        return Auth::user()->direct_clients->count();
    }
}
