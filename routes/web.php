<?php

use App\Http\Controllers\ClientDataController;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

Route::get('locale/{locale}', function ($locale) {
    App::setLocale($locale);
    Session::put("locale", $locale);

    return redirect()->back();
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/getWallets', [DashboardController::class, 'getWallets'])->name('getWallets');
    Route::get('/getDirectClientsCount', [DashboardController::class, 'getDirectClientsCount'])->name('getDirectClientsCount');
    
    /**
     * ==============================
     *          Client Data
     * ==============================
     */
    Route::get('/clientData', [ClientDataController::class, 'index'])->name('clientData');

    /**
     * ==============================
     *           Profile
     * ==============================
     */
    Route::prefix('profile')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /**
     * ==============================
     *           Transaction
     * ==============================
     */
    Route::prefix('transaction')->group(function () {
        Route::get('/withdrawal', [TransactionController::class, 'withdrawal'])->name('transaction.withdrawal');

        //purchase item
        Route::post('/purchaseItem', [TransactionController::class, 'purchaseItem'])->name('transaction.purchaseItem');

        Route::get('/deposit', [TransactionController::class, 'deposit'])->name('transaction.deposit');
        Route::post('/deposit', [TransactionController::class, 'storeDeposit'])->name('transaction.deposit.store');
    });

});

require __DIR__.'/auth.php';
