<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HttpService
{

    private $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client(['base_uri' => config('image.server')]);
    }

    public function postImage($encodedImage)
    {

        try {
            $response = $this->guzzle->post('/', [
                'form_params' => [
                    'imageData' => $encodedImage
                ]
            ]);

            $body = $response->getBody();
            $contents = json_decode($body->getContents());

            return $contents->url;

        } catch (GuzzleException $e) {
            error_log($e->getMessage());
            return $e;
        }
    }
}
