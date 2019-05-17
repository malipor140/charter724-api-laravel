<?php
/**
 * Developed by Alireza Hamedashki.
 * Email: a.hamedashki@gmail.com
 * Mobile: +98 938 900 4559
 * Date: 5/16/19
 * Time: 5:57 PM
 */

namespace Adlino\Charter724\Repositories;

use Adlino\Charter724\Models\Airport;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Charter724Repository
{
    /**
     * TODO:
     * Some Description About This
     */
    private $client;

    /**
     * TODO:
     * Some Description About This
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('charter724.base_uri')]);
    }

    /**
     * TODO:
     * Some Description About This
     * @param $details
     * @return string
     * @throws GuzzleException
     */
    public function generateAccessToken($details)
    {
        $userPassBase64 =  $this->convertToBase64($details);

        $client = new Client();

        $result = $client->request('POST', config('charter724.auth_uri'), [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'UserPassBase64' => $userPassBase64
            ]
        ]);

        $accessToken = json_decode($result->getBody(), true)['Data']['access_token'];

        return $accessToken;
    }

    /**
     * TODO:
     * Some Description About This
     * @param $details
     * @return string
     */
    private function convertToBase64($details)
    {
        $userPassBase64 = "Basic ";

        $userPassBase64.= base64_encode("{$details['username']}:{$details['password']}");

        return $userPassBase64;
    }

    /**
     * TODO:
     * Some Description About This
     */
    private function getAccessToken()
    {
        return config('charter724.access_token');
    }

    /**
     * TODO:
     * Some Description About This
     */
    public function getAirports()
    {
        $airports = $this->client->request('GET', 'Airportlist', [
            'headers' => [
                'Authorization' => "Bearer " . $this->getAccessToken(),
            ]
        ]);

        $airports = json_decode($airports->getBody(), true)['Data'];

        return $airports;
    }

    /**
     * TODO:
     * Some Description About This
     */
    public function storeAirports()
    {
        $airports = $this->getAirports();

        Airport::truncate();

        foreach ($airports as $airport) {
            Airport::create($airport);
        }

        return $airports;
    }

    /**
     * TODO:
     * Some Description About This
     * @param $fromIATA
     * @param $toIATA
     * @return array
     */
    public function getAvailable15Days($fromIATA, $toIATA)
    {
        $available15Days = $this->client->request('POST', 'Available15Days', [
            'headers' => [
                'Authorization' => "Bearer " . $this->getAccessToken(),
            ],
            'form_params' => [
                'from_flight' => $fromIATA,
                'to_flight' => $toIATA
            ]
        ]);

        $available15Days = json_decode($available15Days->getBody(), true)['Data'];

        return $available15Days;
    }

    /**
     * TODO:
     * Some Description About This
     * @param $fromIATA
     * @param $toIATA
     * @param $date
     * @return array
     */
    public function getAvailableFlights($fromIATA, $toIATA, $date)
    {
        $availableFlights = $this->client->request('POST', 'Available', [
            'headers' => [
                'Authorization' => "Bearer " . $this->getAccessToken(),
            ],
            'form_params' => [
                'from_flight' => $fromIATA,
                'to_flight' => $toIATA,
                'date_flight' => $date
            ]
        ]);

        $availableFlights = json_decode($availableFlights->getBody(), true)['Data'];

        return $availableFlights;
    }
}