<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | You can configure your CORS settings here. By default, all requests
    | will allow cross-origin requests from any origin. Feel free to modify
    | this as per your application's requirements.
    |
    */

    'paths' => ['api/*'], // Vous pouvez ajuster les chemins d'accès ici si nécessaire

    'allowed_methods' => ['*'], // Vous pouvez limiter les méthodes HTTP autorisées (GET, POST, etc.)

    'allowed_origins' => ['*'], // Autoriser toutes les origines, sinon spécifiez une origine comme 'http://localhost:3000'

    'allowed_headers' => ['*'], // Autoriser tous les en-têtes

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
