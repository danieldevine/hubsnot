<?php

namespace Coderjerk\Hubsnot;

use GuzzleHttp\Client;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

/**
 * Handles http requests to the Hubspot API.
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class Request
{
    protected array $credentials;

    protected string $base_uri = 'https://api.hubapi.com';

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param string $http_method
     * @param string $path
     * @param array|null $params
     * @param array|null $data
     * @param string|null $api_version
     * @throws GuzzleException
     */
    public function authorisedRequest(
        string $http_method,
        string $endpoint,
        string $section,
        ?array $params,
        ?array $data = null,
        ?string $api_version = 'v3'
    ) {

        $args = [
            'http_method' => $http_method,
            'endpoint'    => $endpoint,
            'section'     => $section,
            'params'      => $params,
            'data'        => $data,
            'api_version' => $api_version
        ];

        if (!isset($this->credentials['hubspot_access_token'])) {
            return;
        }

        $token = $this->credentials['hubspot_access_token'];
        return $this->bearerTokenRequest($args, $token);
    }

    /**
     * OAuth 2 bearer token request
     *
     * @param array $args
     * @param string $token
     * @return object
     * @throws GuzzleException
     */
    public function bearerTokenRequest($args, $token): object
    {
        $client = new Client([
            'base_uri' => $this->base_uri
        ]);

        // dd($client);

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
            ];

            $path =  '/' . $args['section'] . '/' . $args['api_version'] . '/' . $args['endpoint'];

            //thanks to Guzzle's lack of flexibility with url encoding we have to manually set up the query to preserve colons.
            if (isset($args['params'])) {
                $args['params'] = http_build_query($args['params']);
                $path = $path . '?' . str_replace('%3A', ':', $args['params']);
            }

            if (!isset($args['data'])) {
                $args['data'] === null;
            }

            $request  = $client->request($args['http_method'], $path, [
                'headers' => $headers,
                'json'    => $args['data'],
            ]);

            $body = $request->getBody()->getContents();

            return json_decode($body);
        } catch (ClientException | ServerException $e) {
            throw $e;
        }
    }
}
