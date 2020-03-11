<?php

return [
    'attributes' => [
        'email' => 'E-mailadres',
        'first_name' => 'Voornaam',
        'last_name' => 'Achternaam',
        'phone_number' => 'Telefoonnummer',
        'zip_code' => 'Postcode',
        'house_number' => 'Huisnummer',
        'neighbourhood' => 'Wijk',
        'is_admin' => 'Administrator',
        'approved' => 'Goedgekeurd',
        'password' => 'Wachtwoord',
        'password_confirmation' => 'Wachtwoord herhaling',
        'title' => 'Title',
        'short_description' => 'Korte beschrijving',
        'long_description' => 'Lange beschrijving',
        'price' => 'Prijs',
        'enable_bidding' => 'Bieden',
        'minimum_price' => 'Minimum prijs',
        'is_service' => 'Dienst',
        'asking' => 'Vraag',
        'images' => 'Afbeeldingen',
        'remember_password' => 'Wachtwoord onthouden'
    ],
    'unique' => ':attribute is al in gebruik',
    'email' => ':value is geen geldig e-mailadres',
    'exists' => ':attribute bestaat niet',
    'required' => ':attribute is een verplicht veld',
    'max' => ':attribute mag niet langer zijn dan :max karakters',
    'min' => ':attribute mag niet korter zijn dan :min karakters',
    'phone_number' => ':value is geen geldig Nederlands nummer',
    'zip_code' => ':value is geen geldig Nederlandse postcode',
    'confirmed' => ':attribute komt niet overeen',
    'numeric' => ':attribute moet een heel getal zijn',
    'boolean' => ':attribute is een verplicht veld en moet waar of onwaar zijn',
    'image' => ':attribute moet een afbeelding zijn'
];
