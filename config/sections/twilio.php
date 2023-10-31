<?php
return [
    'class' => '\dosamigos\twilio\TwilioComponent',
    'sid' => env('TWILIO_ACCOUNT_SID'),
    'token' => env('TWILIO_AUTH_TOKEN'),
    'phoneNumber' => env('TWILIO_PURCHASED_PHONE_NUMBER')
];