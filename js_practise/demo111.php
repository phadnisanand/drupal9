<?php
$url = 'https://mdy.api-ac.acbpost.be/gcm/v2/User';
$jsonData = '{
  "firstName": "qw",
  "lastName": "qw",
  "email": "aaa@yopmail.com",
  "phone": "13313323232",
  "preferredLanguage": "EN",
  "application": "bpost.be",
  "globalConsents": [
    {
      "consentLevel": 0,
      "userSelection": true
    },
    {
      "consentLevel": 1,
      "userSelection": false,
      "appName": "Maxiresponse"
    },
    {
      "consentLevel": 2,
      "userSelection": true
    }
  ],
  "address": {
    "postalCode": "1000",
    "city": "sdw",
    "street": "dssd",
    "houseNumber": "12",
    "boxNumber": "23",
    "country": "BE"
  }
}';

// use key 'http' even if you send the request to https://...
$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n;x-api-key: a089627f5cae49f59551ad8e490d72ad",
        'method' => 'POST',
        'content' => $jsonData,
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === false) {
    /* Handle error */
}

var_dump($result);