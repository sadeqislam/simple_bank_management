<?php

namespace App;

class Transaction {
    private $type;
    private $amount;
    private $date;

    public function __construct($type, $amount) {
        $this->type = $type;
        $this->amount = $amount;
        $this->date = date('Y-m-d H:i:s');
    }

    public function getDetails() {
        return [
            'type' => $this->type,
            'amount' => $this->amount,
            'date' => $this->date,
        ];
    }
}
