<?php

return [
    'client_id' => env('AYy4wIpULy_uy-rj6oqQCi2Jgyigu8a8tbHxXaDXJsR_18uhy1VFeh0TnPaCEns0reEepFDEDci6dk_e'),
    'secret' => env('AYy4wIpULy_uy-rj6oqQCi2Jgyigu8a8tbHxXaDXJsR_18uhy1VFeh0TnPaCEns0reEepFDEDci6dk_e'),
    'settings' => [
        'mode' => env('PAYPAL_MODE', 'sandbox'), // 'sandbox' または 'live'
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('logs/paypal.log'),
        'log.LogLevel' => 'ERROR'
    ],
];
