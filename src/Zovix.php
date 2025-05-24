<?php

namespace Zovix\Zovix;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Config;

class Zovix
{
    protected $client;
    protected $apiKey;
    protected $apiSecret;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = Config::get('zovix.api_key');
        $this->apiSecret = Config::get('zovix.api_secret');
        $this->baseUrl = rtrim(Config::get('zovix.base_url'), '/');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'X-API-KEY' => $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    /**
     * Generate X-API-SIGN signature for the request
     *
     * @param array $requestBody
     * @return string
     */
    protected function generateSignature(array $requestBody): string
    {
        $queryString = http_build_query($requestBody);
        $signatureHash = hash_hmac('sha256', $queryString, $this->apiSecret, true);
        return base64_encode($signatureHash);
    }

    /**
     * Get a blockchain address for a specific network and client
     *
     * @param string $network Network ISO code (BTC, ETH, BSC, TRON, TON, DOGE)
     * @param string $clientId A unique identifier or label for the address
     * @return array
     * @throws GuzzleException
     */
    public function getBlockchainAddress(string $network, string $clientId): array
    {
        $data = [
            'network' => $network,
            'client_id' => $clientId
        ];

        return $this->post('/my-blockchain/address/get', $data);
    }

    /**
     * Get blockchain address index
     *
     * @return array
     * @throws GuzzleException
     */
    public function getBlockchainAddressIndex(): array
    {
        return $this->get('/my-blockchain/address/index');
    }

    /**
     * Get list of deposits
     *
     * @return array
     * @throws GuzzleException
     */
    public function getDeposits(): array
    {
        return $this->get('/my-blockchain/deposit/index');
    }

    /**
     * Get list of withdrawals
     *
     * @return array
     * @throws GuzzleException
     */
    public function getWithdrawals(): array
    {
        return $this->get('/my-blockchain/withdrawal/index');
    }

    /**
     * Get list of wallets
     *
     * @return array
     * @throws GuzzleException
     */
    public function getWallets(): array
    {
        return $this->get('/my-blockchain/wallet/index');
    }

    /**
     * Get list of pending deposits
     *
     * @return array
     * @throws GuzzleException
     */
    public function getPendingDeposits(): array
    {
        return $this->get('/my-blockchain/deposit/waiting-for-verify');
    }

    /**
     * Verify a deposit
     *
     * @param string $transactionId
     * @return array
     * @throws GuzzleException
     */
    public function verifyDeposit(string $transactionId): array
    {
        $data = [
            'transaction_id' => $transactionId
        ];
        return $this->post('/my-blockchain/deposit/verify', $data);
    }

    /**
     * Create a withdrawal
     *
     * @param string $currency
     * @param string $network
     * @param float $amount
     * @param string $toAddress
     * @return array
     * @throws GuzzleException
     */
    public function withdrawal(string $currency, string $network, float $amount, string $toAddress): array
    {
        $data = [
            'currency' => $currency,
            'network' => $network,
            'amount' => $amount,
            'to_address' => $toAddress
        ];
        return $this->post('/my-blockchain/withdrawal/create', $data);
    }

    /**
     * Make a GET request to the API
     *
     * @param string $endpoint
     * @param array $query
     * @return array
     * @throws GuzzleException
     */
    public function get(string $endpoint, array $query = []): array
    {
        $signature = $this->generateSignature($query);
        
        $response = $this->client->get($endpoint, [
            'query' => $query,
            'headers' => [
                'X-API-SIGN' => $signature
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Make a POST request to the API
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function post(string $endpoint, array $data = []): array
    {
        $signature = $this->generateSignature($data);
        
        $response = $this->client->post($endpoint, [
            'json' => $data,
            'headers' => [
                'X-API-SIGN' => $signature
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
} 