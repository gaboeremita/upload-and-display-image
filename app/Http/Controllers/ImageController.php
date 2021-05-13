<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * @var HttpService
     */
    private $interventionService;

    /**
     * ImageController constructor.
     * @param HttpService $httpService
     */
    public function __construct(HttpService $httpService)
    {
        $this->interventionService = $httpService;
    }

    public function __invoke(Request $request): array
    {
        $request->validate([
            'image' => 'required|image|mimes:png',
        ]);

        if ($request->file('image')->isValid()) {
            $encodedImage = base64_encode(file_get_contents($request->file('image')));

            $imageUrl = $this->interventionService->postImage($encodedImage);

            return compact('imageUrl');

        }
    }
}
