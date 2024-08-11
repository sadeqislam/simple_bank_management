<?php

namespace App;

class Customer extends User {
    private $balance = 0;
    private $transactions = [];

    public function deposit($amount) {
        $this->balance += $amount;
        $this->transactions[] = ['type' => 'deposit', 'amount' => $amount];
    }

    public function withdraw($amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
            $this->transactions[] = ['type' => 'withdraw', 'amount' => $amount];
        } else {
            throw new \Exception("Insufficient balance");
        }
    }

    public function transfer($amount, Customer $recipient) {
        $this->withdraw($amount);
        $recipient->deposit($amount);
        $this->transactions[] = ['type' => 'transfer', 'amount' => $amount, 'to' => $recipient->getEmail()];
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getTransactions() {
        return $this->transactions;
    }
}
