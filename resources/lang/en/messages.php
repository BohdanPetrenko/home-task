<?php

return [
    'transaction' => [
        'success' => 'Transaction was successful',
        'error' => 'Transaction was unsuccessful',
    ],
    'rules' => [
        'balance' => 'Not enough money',
        'luhn' => 'The :attribute card number :number is invalid',
        'cvv' => 'Cvv is invalid',
        'date' => 'Date is invalid',
    ],
];