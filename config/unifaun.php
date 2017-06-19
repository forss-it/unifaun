<?php

return [
    'url' => env('UNIFAUN_URL', "https://api.unifaun.com/rs-extapi/v1"),
    'id' =>  env('UNIFAUN_ID', null),
    'secret' => env('UNIFAUN_SECRET', null),
    //basic, oauth2
    'authentication' => env('UNIFAUN_AUTHENTICATION', "basuc"),
];