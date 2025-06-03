https://Zovix.io
# Zovix Laravel Package

A Laravel package for making HTTP requests to the Zovix API with API key authentication.

## Installation

You can install the package via composer:

```bash
composer require zovix/zovix:dev-main
```

After installing the package, publish the configuration file:

```bash
php artisan vendor:publish --provider="Zovix\Zovix\ZovixServiceProvider" --tag="config"
```

## Configuration

Add the following to your `.env` file:

```env
ZOVIX_API_KEY=your_api_key_here
ZOVIX_API_SECRET=your_api_secret_here
```

## Usage

### Using the Facade

You can use the Zovix package through its facade:

```php
use Zovix\Zovix\Facades\Zovix;

// Get a blockchain address
$address = Zovix::getBlockchainAddress($network, $clientId);

// Get blockchain address index
$addresses = Zovix::getBlockchainAddressIndex($network);

// Get list of deposits
$deposits = Zovix::getDeposits();

// Get list of pending deposits
$pendingDeposits = Zovix::getPendingDeposits();

// Verify Deposit
$verifyDeposit = Zovix::verifyDeposits($transactionId);

// Get list of withdrawals
$withdrawals = Zovix::getWithdrawals();

// Get list of wallets
$wallets = Zovix::getWallets();

// Submit a withdrawal
$withdrawal = Zovix::withdrawal($currency, $network, $amount, $toAddress, $memo);
```

## Security

- The package uses `X-API-KEY` header for authentication
- The package uses `X-API-SIGN` header for request signing
- All requests are made over HTTPS
- API keys and secrets should be kept secure and never exposed in client-side code

## Support

If you encounter any issues or have questions, please open an issue on GitHub.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information. 
