<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\AutoTrading;
use App\Models\CommissionPayout;
use App\Models\SettingWalletAddress;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\DepositRequestNotification;
use App\Services\RunningNumberService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function withdrawal()
    {
        $commission_wallet = Wallet::where('user_id', Auth::id())
            ->where('type', 'commission_wallet')
            ->first();

        $withdrawal_history = Transaction::where([
            'from_wallet_id' => $commission_wallet->id,
            'transaction_type' => 'withdrawal'
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        $autoTradingCount = AutoTrading::where(['user_id' => Auth::id()])->get()->count();

        return Inertia::render('Withdrawal/Withdrawal', [
            'commissionWallet' => $commission_wallet,
            'withdrawalHistory' => $withdrawal_history,
            'autoTradingCount' => $autoTradingCount,
        ]);
    }

    public function storeWithdrawal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:250'],
            'usdt' => ['required'],
        ])->setAttributeNames([
            'amount' => trans('public.amount'),
            'usdt' => trans('public.usdt_address'),
        ]);
        $validator->validate();

        $user_id = Auth::id();
        $user = User::find($user_id);
        $commission_wallet = $user->wallets->where('type', 'commission_wallet')->first();

        if ($commission_wallet->balance < $request->amount) {
            throw ValidationException::withMessages(['amount' => trans('public.insufficient_balance')]);
        }

        $old_bal = $commission_wallet->balance;
        $amount = $request->amount;
        $new_bal = $old_bal - $amount;

        Transaction::create([
            'user_id' => $user_id,
            'category' => 'wallet',
            'transaction_type' => 'withdrawal',
            'from_wallet_id' => $commission_wallet->id,
            'transaction_number' => RunningNumberService::getID('transaction'),
            'to_wallet_address' => $user->usdt_address,
            'amount' => $request->amount,
            'transaction_amount' => $request->receivable,
            'transaction_charges' => $request->charges,
            'old_wallet_amount' => $old_bal,
            'new_wallet_amount' => $new_bal,
            'status' => 'processing',
        ]);

        $commission_wallet->balance = $new_bal;
        $commission_wallet->save();

        return back()
            ->with('title', trans('public.withdrawal_request_submitted'))
            ->with('success', trans('public.withdrawal_request_submitted_desc'))
            ->with('alertButton', trans('public.alright'));
    }

    public function purchaseItem()
    {
        $cash_wallet = Wallet::where('user_id', Auth::id())
            ->where('type', 'cash_wallet')
            ->first();

        $balance = $cash_wallet->balance;
        if ($balance >= 250) {
            $new_bal = $balance - 250;

            Transaction::create([
                'user_id' => Auth::id(),
                'category' => 'wallet',
                'transaction_type' => 'purchase_robotec',
                'from_wallet_id' => $cash_wallet->id,
                'transaction_number' => RunningNumberService::getID('transaction'),
                'amount' => 250,
                'transaction_amount' => 250,
                'transaction_charges' => 0,
                'old_wallet_amount' => $balance,
                'new_wallet_amount' => $new_bal,
                'status' => 'success',
            ]);

            $cash_wallet->balance = $new_bal;
            $cash_wallet->save();

            CommissionPayout::create([
                'upline_id' => Auth::user()->upline_id,
                'downline_id' => Auth::id(),
                'amount' => 250,
                'status' => 'processing',
            ]);

            return back()
                ->with('title', trans('public.purchase_robotec_success'))
                ->with('success', trans('public.purchase_robotec_success_desc') )
                ->with('alertButton', trans('public.alright'));
        }

        return to_route('transaction.deposit')
            ->with('title', trans('public.insufficient_balance'))
            ->with('warning', trans('public.insufficient_balance_desc') )
            ->with('alertButton', trans('public.deposit'));
    }

    public function deposit()
    {
//        $wallet_addresses = SettingWalletAddress::all()->pluck('wallet_address')->shuffle();
        return Inertia::render('Dashboard/Deposit');
    }

    public function storeDeposit(DepositRequest $request)
    {
        $user = Auth::user();
        $cash_wallet = Wallet::where('user_id', $user->id)
            ->where('type', 'cash_wallet')
            ->first();
        $amount = $request->amount;

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'category' => 'wallet',
            'transaction_type' => 'deposit',
            'to_wallet_id' => $cash_wallet->id,
            'transaction_number' => RunningNumberService::getID('transaction'),
            'amount' => $amount,
            'transaction_charges' => 0,
            'transaction_amount' => $amount,
            'old_wallet_amount' => $cash_wallet->balance,
            'status' => 'processing',
        ]);

        $token = Str::random(40);

        $payoutSetting = config('payment-gateway');
        $domain = $_SERVER['HTTP_HOST'];
        $intAmount = intval($amount * 1000000);

        if ($domain === 'login.robotec-user.com') {
            $selectedPayout = $payoutSetting['live'];
        } else {
            $selectedPayout = $payoutSetting['staging'];
        }

        $vCode = md5($intAmount . $selectedPayout['appId'] . $transaction->transaction_number . $selectedPayout['merchantId']);

        $params = [
            'amount' => $intAmount,
            'orderNumber' => $transaction->transaction_number,
            'userId' => $user->id,
            'merchantId' => $selectedPayout['merchantId'],
            'vCode' => $vCode,
            'token' => $token,
        ];

        // Send response
        $url = $selectedPayout['paymentUrl'] . '/payment';
        $redirectUrl = $url . "?" . http_build_query($params);

        return Inertia::location($redirectUrl);
//        $response = Http::acceptJson()->get("https://apilist.tronscanapi.com/api/transaction-info?hash={$request->txid}")->json();
//
//        if ($response) {
//            $transaction->from_wallet_address = $response['ownerAddress'];
//
//            $amount_str = $response['trc20TransferInfo'][0]['amount_str'];
//            $crypto_amount = $transaction->transaction_amount * 1000000;
//            $range = 2 * 1000000;
//            // Update the status of the payment based on the transaction info
//            if ($response['contractRet'] == 'SUCCESS' && $response['confirmed'] && $response['trc20TransferInfo'][0]['to_address'] == $transaction->to_wallet_address) {
//                if ($amount_str >= ($crypto_amount - $range) && $amount_str <= ($crypto_amount + $range)) {
//                    $transaction->status = 'success';
//
//                    $wallet = Wallet::find($transaction->to_wallet_id);
//                    $wallet->balance += $transaction->amount;
//                    $wallet->save();
//
//                    $transaction->new_wallet_amount = $wallet->balance;
//                }
//            }
//        } else {
//            $transaction->from_wallet_address = 'TestOwnerAddress';
//        }
//        $transaction->save();

//        Notification::route('mail', 'payment@currenttech.pro')
//            ->notify(new DepositRequestNotification($transaction, $user));

//        return redirect()->route('dashboard')
//            ->with('title', trans('public.deposit_success'))
//            ->with('success', trans('public.deposit_success_desc'))
//            ->with('alertButton', trans('public.back_to_dashboard'));
    }

    public function deposit_approval($token)
    {
        $transactions = Transaction::with('user')
            ->where('transaction_type', 'deposit')
            ->latest()
            ->get();

        foreach ($transactions as $transaction) {
            $hashed_token = md5($transaction->user->email . $transaction->transaction_number);

            if ($token == $hashed_token) {
                return Inertia::render('DepositApproval', [
                    'transaction' => $transaction,
                    'user_profile_photo' => $transaction->user->getFirstMediaUrl('profile_photo')
                ]);
            }
        }

        // Handle case when no payment matches the token
        return '';
    }

    public function depositRequestApproval(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required'],
            'remarks' => ['required']
        ])->setAttributeNames([
            'status' => trans('public.status'),
            'remarks' => trans('public.remarks')
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $status = $request->status == 'approve' ? 'success' : 'failed';
            $transaction = Transaction::find($request->transaction_id);
            $transaction->update([
                'status' => $status,
                'remarks' => $request->remarks,
                'approved_at' => now(),
                'handle_by' => 1,
            ]);

            if ($transaction->status == 'success') {
                $wallet = Wallet::find($transaction->to_wallet_id);
                $wallet->balance += $transaction->transaction_amount;
                $wallet->save();

                $transaction->new_wallet_amount = $wallet->balance;
                $transaction->save();

                $title = trans('public.approve_deposit');
            } else {
                $transaction->new_wallet_amount = $transaction->old_wallet_amount;
                $transaction->save();

                $title = trans('public.reject_deposit');
            }

            return redirect()->back()
                ->with('title', $title)
                ->with('success', trans('public.deposit_approval_return_message', ['transaction_number' => $transaction->transaction_number, 'status' => trans('public.' . $transaction->status)]));
        }
    }

    //payment gateway return function
    public function depositReturn(Request $request)
    {
        $data = $request->all();

        return redirect()->route('dashboard')
            ->with('title', trans('public.deposit_success'))
            ->with('success', trans('public.deposit_success_desc'))
            ->with('alertButton', trans('public.back_to_dashboard'));
    }

    public function depositCallback(Request $request)
    {
        $data = $request->all();

        $result = [
            "token" => $data['token'],
            "transactionID" => $data['transactionID'],
            "address" => $data["address"],
            "amount" => $data["amount"],
            "status" => $data["status"],
            "remarks" => $data["remarks"],
        ];

        Log::debug($result);

        $transaction = Transaction::query()
            ->where('transaction_number', $result['transactionID'])
            ->first();

        $dataToHash = md5($transaction->transaction_number . $transaction->to_wallet_address);

        if ($result['token'] === $dataToHash) {
            //proceed approval
            $transaction->update([
                'status' => $result['status'],
                'remarks' => $result['remarks']
            ]);
            if ($transaction->status =='success') {
                if ($transaction->transaction_type == 'deposit') {
                    $wallet = Wallet::find($transaction->to_wallet_id);

                    $wallet->update([
                        'balance' => $wallet->balance + $transaction->transaction_amount
                    ]);

                    $user = User::find($transaction->user_id);

                    Notification::route('mail', 'payment@currenttech.pro')
                        ->notify(new DepositRequestNotification($transaction, $user));

                    return response()->json(['success' => true, 'message' => 'Deposit Success']);

                }
            }
        }

        return response()->json(['success' => false, 'message' => 'Deposit Failed']);
    }
}
