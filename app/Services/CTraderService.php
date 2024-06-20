<?php

namespace App\Services;

use AleeDhillon\MetaFive\Entities\Trade;
use App\Models\User as UserModel;
use App\Services\Data\CreateTradingAccount;
use App\Services\Data\CreateTradingUser;
use App\Services\Data\UpdateTradingAccount;
use App\Services\Data\UpdateTradingUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CTraderService
{
    private string $host = "https://live-quantumcapital.webapi.ctrader.com";
    private string $port = "8443";
    private string $login = "10012";
    private string $password = "Test1234.";
    private string $baseURL = "https://live-quantumcapital.webapi.ctrader.com:8443";
    private string $token = "6f0d6f97-3042-4389-9655-9bc321f3fc1e";
    private string $brokerName = "quantumcapitalglobal";
    private string $environmentName = "live";

    public function connectionStatus(): array
    {
        return [
            'code' => 0,
            'message' => "OK",
        ];
    }

    public function CreateCTID($email)
    {
        return Http::acceptJson()->post($this->baseURL . "/cid/ctid/create?token=$this->token", [
            'brokerName' => $this->brokerName,
            'email' => $email,
            'preferredLanguage' => 'EN',
        ])->json();
    }

    public function linkAccountTOCTID($meta_login, $password, $userId): void
    {
        $response = Http::acceptJson()->post($this->baseURL . "/cid/ctid/link?token=$this->token", [
            'traderLogin' => $meta_login,
            'traderPasswordHash' => md5($password),
            'userId' => $userId,
            'brokerName' => $this->brokerName,
            'environmentName' => $this->environmentName,
            'returnAccountDetails' => false,
        ])->json();

        Log::debug($response);
    }

    public function createUser(UserModel $user, $mainPassword, $investorPassword, $group, $leverage, $accountType, $leadCampaign = null, $leadSource = null, $remarks = null)
    {
        $accountResponse = Http::acceptJson()->post($this->baseURL . "/v2/webserv/traders?token={$this->token}", [
            'hashedPassword' => md5($mainPassword),
            'groupName' => $group,
            'depositCurrency' => 'USD',
            'name' => $user->name,
            'description' => $remarks,
            'accessRights' => CTraderAccessRights::NO_TRADING,
            'balance' => 0,
            'leverageInCents' => $leverage * 100,
            'contactDetails' => [
                'phone' => $user->phone,
            ],
            'accountType' => CTraderAccountType::HEDGED,
        ]);

        $accountResponse = $accountResponse->json();

        $response = $this->linkAccountTOCTID($accountResponse['login'], $mainPassword, $user->ct_user_id);
        Log::debug($response);
        (new CreateTradingUser)->execute($user, $accountResponse, $accountType, $remarks);
        (new CreateTradingAccount)->execute($user, $accountResponse, $accountType);
        return $accountResponse;
    }

    public function getUser($meta_login)
    {
        $response = Http::acceptJson()->get($this->baseURL . "/v2/webserv/traders/{$meta_login}?token={$this->token}")->json();
        //TraderTO
        Log::debug($response);
        return $response;
    }

    //changeTradeerBalance
    public function createTrade($meta_login, $amount, $comment, $type): Trade
    {
        $response = Http::acceptJson()->post($this->baseURL . "/v2/webserv/traders/{$meta_login}/changebalance?token={$this->token}", [
            'login' => $meta_login,
            'amount' => $amount * 100, //
            'preciseAmount' => $amount, //
            'type' => $type,
            'comment' => $comment, //
            /* 'externalNote' => '', //
            'source' => '', //
            'externalId' => '', // */
        ]);
        $response = $response->json();
        Log::debug($response);
        $trade = new Trade();
        $trade->setAmount($amount);
        $trade->setComment($comment);
        $trade->setType($type);
        $trade->setTicket($response['balanceHistoryId']);


        $data = $this->getUser($meta_login);
        (new UpdateTradingUser)->execute($meta_login, $data);
        (new UpdateTradingAccount)->execute($meta_login, $data);
        return $trade;
    }

    public function getUserInfo($trading_users): void
    {
        foreach ($trading_users as $row) {
            $data = $this->getUser($row->meta_login);
            if ($data) {
                (new UpdateTradingUser)->execute($row->meta_login, $data);
                (new UpdateTradingAccount)->execute($row->meta_login, $data);
            }
        }
    }
}

class CTraderAccessRights
{
    const FULL_ACCESS = "FULL_ACCESS";
    const CLOSE_ONLY = "CLOSE_ONLY";
    const NO_TRADING = "NO_TRADING";
    const NO_LOGIN = "NO_LOGIN";
}

class CTraderAccountType
{
    const HEDGED = "HEDGED";
    const NETTED = "NETTED";
}

class ChangeTraderBalanceType
{
    const DEPOSIT = "DEPOSIT";
    const DEPOSIT_NONWITHDRAWABLE_BONUS = "DEPOSIT_NONWITHDRAWABLE_BONUS";
    const WITHDRAW = "WITHDRAW";
    const WITHDRAW_NONWITHDRAWABLE_BONUS = "WITHDRAW_NONWITHDRAWABLE_BONUS";
}
