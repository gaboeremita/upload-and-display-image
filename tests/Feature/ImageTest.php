<?php

namespace Tests\Feature;

use App\Services\HttpService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Throwable;

class ImageTest extends TestCase
{

    use WithFaker;

    /**
     * @var HttpService
     */
    private $httpService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpFaker();
        $this->httpService = new HttpService();
    }

    /** @test */
    public function a_valid_encoded_image_can_be_posted()
    {

        $image = $this->faker->image();

        $encodedImage = base64_encode($image);

        $imageUrl = $this->httpService->postImage($encodedImage);

        $this->assertStringContainsString('https://test.rxflodev.com/image-store/', $imageUrl);
    }

    /** @test
     * @throws Throwable
     */
    public function a_non_valid_image_cannot_be_posted()
    {
        $fakeImageJpg = UploadedFile::fake()->image('fake_image.jpg');

        $response = $this->post('/api/images', [
            'images' => [$fakeImageJpg]
        ]);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The given data was invalid.');
        
        $response->decodeResponseJson();
    }
}
