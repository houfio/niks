<?php

namespace App\Services;

use App\Models\Coordinates;
use GuzzleHttp\Client;

class LocationService
{
    private const URL = 'https://bag.basisregistraties.overheid.nl/api/v1';
    private const LOCATION = '/nummeraanduidingen';
    private string $apiKey;
    private Client $client;

    public function __construct()
    {
        $this->apiKey = getenv('KADASTER_API_KEY');
        $this->client = new Client();
    }

    public function getCoordinates(string $zipCode, string $houseNumber): ?Coordinates
    {
        $response = $this->makeCall('GET', self::URL, self::LOCATION, "postcode=$zipCode&huisnummer=$houseNumber");

        if (!isset($response->nummeraanduidingen[0])) {
            return null;
        }

        $url = $response->nummeraanduidingen[0]
            ->_links
            ->adresseerbaarObject
            ->href;

        $response = $this->makeCall('GET', $url);
        $coordinates = $response->geometrie->coordinates;

        return new Coordinates($coordinates[1], $coordinates[0]);
    }

    private function makeCall(string $method, string $url, string $endpoint = '', string $query = ''): ?object
    {
        $response = $this->client->request($method, $endpoint ? "$url$endpoint?$query" : $url, [
            'headers' => [
                'X-Api-Key' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody())->_embedded;
    }
}
