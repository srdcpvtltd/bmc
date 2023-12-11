<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'bill_desk' => [
        'client_id' => env('BILL_DESK_CLIENT_ID','ids6bmmunc'),
        'merchant_id' => env('BILL_DESK_MECHANT_ID','IDS6BMMUNC'),
        'order_url' => env('BILL_DESK_ORDER_URL','https://api.billdesk.com/payments/ve1_2/orders/create'),
    ],
    'razor_pay' => [
        'merchant_name' => env('MERCHANT_NAME','SHOP System'),
        'merchant_id' => env('MERCHANT_ID','APIMER'),
        'merchant_sub_id' => env('MERCHANT_SUB_ID','BHUMLU'),
        'encryption_key' => env('ENCRYPTION_KEY','84BA57072F1E39ED568B73729B1A398B'),
        'encryption_iv' => env('ENCRYPTION_IV','vH6YAokqhPd45z2g'),
        'sign_key' => env('SIGN_KEY','vH6YAokqhPd45z2g'),
        'secret_password_hash' => env('SECRET_PASSWORD_HASH','9C7B13D3C95E56B21C629F8C2D7FB3545AD11779213E7B33FED5C15466C7508D'),
        'token_generate_url' => env('TOKEN_GENERATE_URL','https://www.iobnet.co.in/iobpay/iobpayRESTService/apitokenservice/generatenewtoken/'),
        'txn_initiation_url' => env('TXN_INITIATION_URL','https://www.iobnet.co.in/iobpay/apitxninit.do'),
        'tnx_status_url' => env('TXN_STATUS_URL','https://www.iobnet.co.in/iobpay/iobpayRESTService/apitxnstatusservice/gettxnstatus/'),
    ],

];
