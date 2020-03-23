<?php

return [
    'unauthorized' => [
        'title' => '401/403 - Geen autorisatie',
        'description' => 'Om deze pagina te bekijken dien je ingelogd te zijn.'
    ],
    'not_found' => [
        'title' => '404 - Pagina niet gevonden',
        'description' => 'De pagina die je probeert te bereiken bestaat niet. Is de URL wel correct?'
    ],
    'expired' => [
        'title' => '419 - Pagina verlopen',
        'description' => 'De pagina die je probeert te bereiken is verlopen. Ben je nog wel ingelogd?'
    ],
    'too_many_requests' => [
        'title' => '429 - Te veel verzoeken',
        'description' => 'U heeft te veel verzoeken gemaakt naar de webserver en bent tijdelijk geblokkeerd.'
    ],
    'server_error' => [
        'title' => '500 - Webserver foutmelding',
        'description' => 'Er is iets foutgegaan met de webserver. We proberen het zo snel mogelijk op te lossen!'
    ],
    'service_unavailable' => [
        'title' => '503 - Webserver tijdelijk niet bereikbaar',
        'description' => 'De webserver is tijdelijk niet bereikbaar. We proberen het zo snel mogelijk op te lossen!'
    ]
];
