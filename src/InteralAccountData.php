<?php

namespace App;

class InternalAccountData
{
    public string $id;
    public ?string $account_type;
    public string $party_name;
    public ?string $party_type;
    public ?object $party_address;
    public array $account_details;
    public array $routing_details;
    public ?object $connection;
    public string $currency;
    public ?string $parent_account_id;
    public ?string $counterparty_id;
    public ?string $ledger_account_id;
    public array $metadata;
    public bool $live_mode;
    public string $created_at;
    public string $updated_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? '';
        $this->account_type = $data['account_type'] ?? null;
        $this->party_name = $data['party_name'] ?? '';
        $this->party_type = $data['party_type'] ?? null;
        $this->party_address = $data['party_address'] ?? null;
        $this->account_details = $data['account_details'] ?? [];
        $this->routing_details = $data['routing_details'] ?? [];
        $this->connection = $data['connection'] ?? null;
        $this->currency = $data['currency'] ?? '';
        $this->parent_account_id = $data['parent_account_id'] ?? null;
        $this->counterparty_id = $data['counterparty_id'] ?? null;
        $this->ledger_account_id = $data['ledger_account_id'] ?? null;
        $this->metadata = $data['metadata'] ?? [];
        $this->live_mode = $data['live_mode'] ?? false;
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'account_type' => $this->account_type,
            'party_name' => $this->party_name,
            'party_type' => $this->party_type,
            'party_address' => $this->party_address,
            'account_details' => $this->account_details,
            'routing_details' => $this->routing_details,
            'connection' => $this->connection,
            'currency' => $this->currency,
            'parent_account_id' => $this->parent_account_id,
            'counterparty_id' => $this->counterparty_id,
            'ledger_account_id' => $this->ledger_account_id,
            'metadata' => $this->metadata,
            'live_mode' => $this->live_mode,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
