<?php
return [
  'merchant_id' => env('MERCHANT_ID'),
  'client_key' => env('CLIENT_KEY'),
  'server_key' => env('SERVER_KEY'),

  'is_production' => env('MIDTRANS_IS_PRODUCTION'),
  'is_sanitized' => false,
  'is_3ds' => false,
];
