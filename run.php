<?php

require 'vendor/autoload.php';

use App\ModernTreasuryClient;
use App\PaymentOrderData;

$organizationId = getenv('ORGANIZATION_ID');
$apiKey = getenv('API_KEY');
$client = new ModernTreasuryClient($apiKey, $organizationId);

$command = $argv[1] ?? null;

switch ($command) {
    case 'create_payment_order':
        $amount = $argv[2] ?? null;
        $currency = $argv[3] ?? null;
        $direction = $argv[4] ?? null;
        $type = $argv[5] ?? null;
        $originating_account_id = $argv[6] ?? null;
        $receiving_account_id = $argv[7] ?? null;
        $description = $argv[8] ?? null;

        if (!$amount || !$currency || !$direction || !$type || !$receiving_account_id || !$description) {
            echo "Usage: php run.php create_payment_order <amount> <currency> <direction> <type> <receiving_account_id> <description>\n";
            exit(1);
        }

        $paymentOrderData = new PaymentOrderData($amount, $currency, $direction, $type, $originating_account_id, $receiving_account_id, $description);
        $response = $client->createPaymentOrder($paymentOrderData);
        print_r($response);
        break;

    case 'get_payment_order':
        $id = $argv[2] ?? null;

        if (!$id) {
            echo "Usage: php run.php get_payment_order <id>\n";
            exit(1);
        }

        $response = $client->getPaymentOrder($id);
        print_r($response);
        break;

    case 'list_payment_orders':
        $response = $client->listPaymentOrders();
        print_r($response);
        break;

    case 'update_payment_order':
        $id = $argv[2] ?? null;
        $amount = $argv[3] ?? null;
        $currency = $argv[4] ?? null;
        $direction = $argv[5] ?? null;
        $type = $argv[6] ?? null;
        $receiving_account_id = $argv[7] ?? null;
        $description = $argv[8] ?? null;

        if (!$id || !$amount || !$currency || !$direction || !$type || !$receiving_account_id || !$description) {
            echo "Usage: php run.php update_payment_order <id> <amount> <currency> <direction> <type> <receiving_account_id> <description>\n";
            exit(1);
        }

        $paymentOrderData = new PaymentOrderData($amount, $currency, $direction, $type, $receiving_account_id, $description);
        $response = $client->updatePaymentOrder($id, $paymentOrderData);
        print_r($response);
        break;

    case 'delete_payment_order':
        $id = $argv[2] ?? null;

        if (!$id) {
            echo "Usage: php run.php delete_payment_order <id>\n";
            exit(1);
        }

        $response = $client->deletePaymentOrder($id);
        print_r($response);
        break;

    case 'create_internal_account':
        $connectionId = $argv[2] ?? null;
        $name = $argv[3] ?? null;
        $partyName = $argv[4] ?? null;
        $currency = $argv[5] ?? null;
        $parentAccountId = $argv[6] ?? null;
        $counterpartyId = $argv[7] ?? null;
        $metadata = $argv[8] ?? null;
        $partyAddress = $argv[9] ?? null;

        if (!$connectionId || !$name || !$partyName || !$currency) {
            echo "Usage: php run.php create_internal_account <connection_id> <name> <party_name> <currency> [parent_account_id] [counterparty_id] [metadata] [party_address]\n";
            exit(1);
        }

        $data = [
            'connection_id' => $connectionId,
            'name' => $name,
            'party_name' => $partyName,
            'currency' => $currency,
            'parent_account_id' => $parentAccountId,
            'counterparty_id' => $counterpartyId,
            'metadata' => $metadata,
            'party_address' => $partyAddress,
        ];

        $response = $client->createInternalAccount($data);
        print_r($response);
        break;

    case 'list_internal_accounts':
        $currency = $argv[2] ?? null;
        $paymentType = $argv[3] ?? null;
        $paymentDirection = $argv[4] ?? null;
        $afterCursor = $argv[5] ?? null;
        $perPage = $argv[6] ?? 25;
        $metadata = $argv[7] ?? null;
        $counterpartyId = $argv[8] ?? null;
        $legalEntityId = $argv[9] ?? null;

		$requestProperties = [
    		'currency' => $currency,
    		'paymentType' => $paymentType,
    		'paymentDirection' => $paymentDirection,
    		'afterCursor' => $afterCursor,
    		'perPage' => $perPage,
    		'metadata' => $metadata,
    		'counterpartyId' => $counterpartyId,
    		'legalEntityId' => $legalEntityId,
		];


        $response = $client->listInternalAccounts($requestProperties);
        print_r($response);
        break;

    case 'get_internal_account':
        $id = $argv[2] ?? null;

        if (!$id) {
            echo "Usage: php run.php get_internal_account <id>\n";
            exit(1);
        }

        $response = $client->getInternalAccount($id);
        print_r($response);
        break;

    case 'update_internal_account':
        $id = $argv[2] ?? null;
        $name = $argv[3] ?? null;
        $metadata = $argv[4] ?? null;
        $parentAccountId = $argv[5] ?? null;
        $counterpartyId = $argv[6] ?? null;
        $ledgerAccountId = $argv[7] ?? null;

        if (!$id) {
            echo "Usage: php run.php update_internal_account <id> [name] [metadata] [parent_account_id] [counterparty_id] [ledger_account_id]\n";
            exit(1);
        }

        $data = [
            'name' => $name,
            'metadata' => $metadata,
            'parent_account_id' => $parentAccountId,
            'counterparty_id' => $counterpartyId,
            'ledger_account_id' => $ledgerAccountId,
        ];

        $response = $client->updateInternalAccount($id, $data);
        print_r($response);
        break;

    default:
        echo "Usage: php run.php <command> [parameters]\n";
        echo "Commands:\n";
        echo "  create_payment_order <amount> <currency> <direction> <type> <receiving_account_id> <description>\n";
        echo "  get_payment_order <id>\n";
        echo "  list_payment_orders\n";
        echo "  update_payment_order <id> <amount> <currency> <direction> <type> <receiving_account_id> <description>\n";
        echo "  delete_payment_order <id>\n";
        echo "  create_internal_account <connection_id> <name> <party_name> <currency> [parent_account_id] [counterparty_id] [metadata] [party_address]\n";
        echo "  list_internal_accounts [currency] [payment_type] [payment_direction] [after_cursor] [per_page] [metadata] [counterparty_id] [legal_entity_id]\n";
        echo "  get_internal_account <id>\n";
        echo "  update_internal_account <id> [name] [metadata] [parent_account_id] [counterparty_id] [ledger_account_id]\n";
        break;
}
