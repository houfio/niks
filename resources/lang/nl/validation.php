<?php

return [
    'attributes' => [
        'email' => 'E-mailadres',
        'firstName' => 'Voornaam',
        'middleName' => 'Tussenvoegsel',
        'lastName' => 'Achternaam',
        'phoneNumber' => 'Telefoonnummer',
        'zipCode' => 'Postcode',
        'houseNumber' => 'Huisnummer',
        'neighbourhood' => 'Wijk'
    ],
    'unique' => ':attribute is al in gebruik',
    'email' => ':value is geen geldig e-mailadres',
    'exists' => ':attribute bestaat niet',
    'required' => ':attribute is een verplicht veld',
    'max' => ':attribute mag niet langer zijn dan :max karakters',
    'phone_number' => ':value is geen geldig Nederlands nummer',
    'zip_code' => ':value is geen geldig Nederlandse postcode'
];
