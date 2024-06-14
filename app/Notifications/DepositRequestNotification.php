<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepositRequestNotification extends Notification
{
    protected $transaction;
    protected $user;

    public function __construct($transaction, $user) {
        $this->transaction = $transaction;
        $this->user = $user;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $token = md5($this->user->email . $this->transaction->transaction_number);
        return (new MailMessage)
            ->subject('Deposit Approval - ' . $this->transaction->transaction_number)
            ->greeting('Deposit Approval- ' . $this->transaction->transaction_number)
            ->line('Email: ' . $this->user->email)
            ->line('Name: ' . $this->user->name)
            ->line('Deposit Amount: $ ' . number_format($this->transaction->amount, 2))
            ->line('TxID: ' . $this->transaction->txn_hash)
            ->line('Click the button to proceed with approval')
            ->action('Approval', route('transaction.deposit_approval', [
                'token' => $token,
            ]))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
