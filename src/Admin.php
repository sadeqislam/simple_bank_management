<?php

namespace App;

class Admin extends User {
    public function viewAllCustomers(Storage $storage) {
        return $storage->read();
    }

    public function viewCustomerTransactions(Storage $storage, $email) {
        $customers = $storage->read();
        foreach ($customers as $customer) {
            if ($customer['email'] == $email) {
                return $customer['transactions'];
            }
        }
        return [];
    }
}
