<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class ModernTreasuryClient
 *
 * A client for interacting with the Modern Treasury API.
 */
class ModernTreasuryClient
{
    private $client;
    private $orgID;
    private $apiKey;
    private $baseUri = 'https://app.moderntreasury.com/api/';

    /**
     * ModernTreasuryClient constructor.
     *
     * @param string $apiKey Your Modern Treasury API key.
     * @param string $orgID Your Modern Treasury Organization ID.
     */
    public function __construct($apiKey, $orgID)
    {
        $this->apiKey = $apiKey;
        $this->orgID = $orgID;
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->orgID . ':' . $this->apiKey),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Make an HTTP request.
     *
     * @param string $method The HTTP method.
     * @param string $uri The URI.
     * @param array $options The request options.
     * @return array The response data.
     * @throws RequestException
     */
    private function request($method, $uri, $options = [])
    {
        try {
            $response = $this->client->request($method, $uri, $options);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return json_decode($e->getResponse()->getBody(), true);
            }
            throw $e;
        }
    }

    /**
     * Create a payment order.
     *
     * @param PaymentOrderData $data The payment order data.
     * @return array The created payment order.
     *
     * @OA\Post(
     *     path="/payment_orders",
     *     summary="Create a payment order",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PaymentOrderData")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PaymentOrder")
     *     )
     * )
     */
    public function createPaymentOrder(PaymentOrderData $data)
    {
        return $this->request('POST', 'payment_orders', [
            'json' => $data->toArray(),
        ]);
    }

    /**
     * Get a payment order by ID.
     *
     * @param string $id The payment order ID.
     * @return array The payment order data.
     *
     * @OA\Get(
     *     path="/payment_orders/{id}",
     *     summary="Get a payment order by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PaymentOrder")
     *     )
     * )
     */
    public function getPaymentOrder($id)
    {
        return $this->request('GET', "payment_orders/{$id}");
    }

    /**
     * List all payment orders.
     *
     * @param array $params Query parameters.
     * @return array The list of payment orders.
     *
     * @OA\Get(
     *     path="/payment_orders",
     *     summary="List all payment orders",
     *     @OA\Parameter(
     *         name="params",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="array", @OA\Items(type="string"))
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PaymentOrder"))
     *     )
     * )
     */
    public function listPaymentOrders($params = [])
    {
        return $this->request('GET', 'payment_orders', [
            'query' => $params,
        ]);
    }

    /**
     * Update a payment order by ID.
     *
     * @param string $id The payment order ID.
     * @param PaymentOrderData $data The payment order data.
     * @return array The updated payment order.
     *
     * @OA\Patch(
     *     path="/payment_orders/{id}",
     *     summary="Update a payment order by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PaymentOrderData")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PaymentOrder")
     *     )
     * )
     */
    public function updatePaymentOrder($id, PaymentOrderData $data)
    {
        return $this->request('PATCH', "payment_orders/{$id}", [
            'json' => $data->toArray(),
        ]);
    }

    /**
     * Delete a payment order by ID.
     *
     * @param string $id The payment order ID.
     * @return array The response data.
     *
     * @OA\Delete(
     *     path="/payment_orders/{id}",
     *     summary="Delete a payment order by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PaymentOrder")
     *     )
     * )
     */
    public function deletePaymentOrder($id)
    {
        return $this->request('DELETE', "payment_orders/{$id}");
    }
}
