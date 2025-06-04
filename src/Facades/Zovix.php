<?php

namespace Zovix\Zovix\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getBlockchainAddress(string $network, string $clientId)
 * @method static array getBlockchainAddressIndex()
 * @method static array getDeposits()
 * @method static array getWithdrawals(?string $uniqueParam = null)
 * @method static array getWallets()
 * @method static array getNetworks()
 * @method static array getPendingDeposits()
 * @method static array verifyDeposit(string $transactionId)
 * @method static array withdrawal(string $currency, string $network, float $amount, string $toAddress, string $uniqueParam, ?string $memo = null)
 * @method static array get(string $endpoint, array $query = [])
 * @method static array post(string $endpoint, array $data = [])
 *
 * @see \Zovix\Zovix\Zovix
 */
class Zovix extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'zovix';
    }
} 
