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
            'image' => 'required|image|mimes:png',
        ]);

        if ($request->file('image')->isValid()) {
            $encodedImage = base64_encode(file_get_contents($request->file('image')));

            try {
                $imageUrl = $this->httpService->postImage($encodedImage);

                return response(compact('imageUrl'));
            } catch(\Exception $e) {
                return response(['message' => 'An unknown error occurred'], 500);
            }
        }

        return response(['message' => 'Invalid image'], 500);
    }
}
