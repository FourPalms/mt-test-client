<?php

namespace App;

/**
 * Class representing the data required to create or update a payment order.
 */
class PaymentOrderData
{
    public $amount;
    public $currency;
    public $direction;
    public $type;
    public $receiving_account_id;
    public $originating_account_id;
    public $description;

    /**
     * PaymentOrderData constructor.
     *
     * @param int $amount The amount of the payment order.
     * @param string $currency The currency of the payment order.
     * @param string $direction The direction of the payment order (e.g., 'credit').
     * @param string $type The type of the payment order (e.g., 'ach').
     * @param string $originatingAccountId The ID of the originating account.
     * @param string $receiving_account_id The ID of the receiving account.
     * @param string $description A description of the payment order.
     */
    public function __construct($amount, $currency, $direction, $type, $originatingAccountId, $receiving_account_id, $description)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->direction = $direction;
        $this->type = $type;
        $this->originating_account_id = $originatingAccountId;
        $this->receiving_account_id = $receiving_account_id;
        $this->description = $description;
    }

    /**
     * Convert the PaymentOrderData object to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'direction' => $this->direction,
            'type' => $this->type,
			'originating_account_id' => $this->originating_account_id,
            'receiving_account_id' => $this->receiving_account_id,
            'description' => $this->description,
        ];
    }
}

