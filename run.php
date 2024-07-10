<?php

require 'vendor/autoload.php';

use App\ModernTreasuryClient;
use App\PaymentOrderData;

$organizationId = getenv('ORGANIZATION_ID');
$apiKey = getenv('API_KEY');
$client = new ModernTreasuryClient($apiKey, $organizationId);

$command = $argv[1] ?? null;

switch ($command) {
    case 'create':
        $amount = $argv[2] ?? null;
        $currency = $argv[3] ?? null;
        $direction = $argv[4] ?? null;
        $type = $argv[5] ?? null;
		$originating_account_id = $argv[6] ?? null;
        $receiving_account_id = $argv[7] ?? null;
        $description = $argv[8] ?? null;

        if (!$amount || !$currency || !$direction || !$type || !$receiving_account_id || !$description) {
            echo "Usage: php run.php create <amount> <currency> <direction> <type> <receiving_account_id> <description>\n";
            exit(1);
        }

        $paymentOrderData = new PaymentOrderData($amount, $currency, $direction, $type, $originating_account_id, $receiving_account_id, $description);
        $response = $client->createPaymentOrder($paymentOrderData);
        print_r($response);
        break;

    case 'get':
        $id = $argv[2] ?? null;

        if (!$id) {
            echo "Usage: php run.php get <id>\n";
            exit(1);
        }

        $response = $client->getPaymentOrder($id);
        print_r($response);
        break;

    case 'list':
        $response = $client->listPaymentOrders();
        print_r($response);
        break;

    case 'update':
        $id = $argv[2] ?? null;
        $amount = $argv[3] ?? null;
        $currency = $argv[4] ?? null;
        $direction = $argv[5] ?? null;
        $type = $argv[6] ?? null;
        $receiving_account_id = $argv[7] ?? null;
        $description = $argv[8] ?? null;

        if (!$id || !$amount || !$currency || !$direction || !$type || !$receiving_account_id || !$description) {
            echo "Usage: php run.php update <id> <amount> <currency> <direction> <type> <receiving_account_id> <description>\n";
            exit(1);
        }

        $paymentOrderData = new PaymentOrderData($amount, $currency, $direction, $type, $receiving_account_id, $description);
        $response = $client->updatePaymentOrder($id, $paymentOrderData);
        print_r($response);
        break;

    case 'delete':
        $id = $argv[2] ?? null;

        if (!$id) {
            echo "Usage: php run.php delete <id>\n";
            exit(1);
        }

        $response = $client->deletePaymentOrder($id);
        print_r($response);
        break;

    default:
        echo "Usage: php run.php <command> [parameters]\n";
        echo "Commands:\n";
        echo "  create <amount> <currency> <direction> <type> <receiving_account_id> <description>\n";
        echo "  get <id>\n";
        echo "  list\n";
        echo "  update <id> <amount> <currency> <direction> <type> <receiving_account_id> <description>\n";
        echo "  delete <id>\n";
        break;
}
