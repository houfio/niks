<?php

return [
    'attributes' => [
        'email' => 'e-mailadres',
        'firstName' => 'voornaam',
        'middleName' => 'tussenvoegsel',
        'lastName' => 'achternaam'
    ],
    'unique' => ':attribute is al in gebruik',
    'required' => ':attribute is een verplicht veld',
    'max' => ':attribute mag niet langer zijn dan :max karakters'
];
