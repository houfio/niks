<?php

return [
    'attributes' => [
        'email' => 'E-mailadres',
        'firstName' => 'Voornaam',
        'middleName' => 'Tussenvoegsel',
        'lastName' => 'Achternaam'
    ],
    'unique' => ':attribute is al in gebruik',
    'required' => ':attribute is een verplicht veld',
    'max' => ':attribute mag niet langer zijn dan :max karakters'
];
