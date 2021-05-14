<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * @var HttpService
     */
    private $httpService;

    /**
     * ImageController constructor.
     * @param HttpService $httpService
     */
    public function __construct(HttpService $httpService)
    {
        $this->httpService = $httpService;
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:png',
        ]);

        $images = $request->file('images');
        $imagesArray = [];

        foreach ($images as $image) {

            if($image->isValid()) {
                $encodedImage = base64_encode(file_get_contents($image));
                $imageUrl = $this->httpService->postImage($encodedImage);
                $imagesArray[] = ['url' => $imageUrl, 'name' => $image->getClientOriginalName()];
            }
        }

        return response(compact('imagesArray'));
    }
}
