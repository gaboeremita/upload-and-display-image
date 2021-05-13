<?php

namespace App\Http\Controllers;

use App\Services\InterventionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * @var InterventionService
     */
    private $interventionService;

    /**
     * ImageController constructor.
     * @param InterventionService $interventionService
     */
    public function __construct(InterventionService $interventionService)
    {
        $this->interventionService = $interventionService;
    }

    public function index() {
        $images = $this->interventionService->getImages();

        return response()->json($images);
    }

    public function store(Request $request) {
        $imageUrl = $request->input('image_url');
        
        $this->interventionService->postImage($imageUrl);

        return response()->json('ok');
    }
}
