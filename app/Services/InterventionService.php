<?php

namespace App\Services;

use App\Services\Contracts\Imageable;

class InterventionService implements Imageable
{
    
    private $remoteServerUrl;

    public function __construct()
    {
        $this->remoteServerUrl = config('image.server');

    }

    public function postImage()
    {
        // TODO: Implement postImage() method.
    }

    public function getImages()
    {
        // TODO: Implement getImages() method.
    }
}
