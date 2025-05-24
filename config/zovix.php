<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Zovix API Key
    |--------------------------------------------------------------------------
    |
    | This is your Zovix API key. You can find this in your Zovix dashboard.
    |
    */
    'api_key' => env('ZOVIX_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Zovix API Secret
    |--------------------------------------------------------------------------
    |
    | This is your Zovix API secret. You can find this in your Zovix dashboard.
    | This is used to generate the X-API-SIGN header for request authentication.
    |
    */
    'api_secret' => env('ZOVIX_API_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Zovix Base URL
    |--------------------------------------------------------------------------
    |
    | This is the base URL for the Zovix API.
    |
    */
    'base_url' => 'https://api.zovix.io/my-blockchain',
]; 