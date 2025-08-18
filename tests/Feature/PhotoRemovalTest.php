<?php

namespace Tests\Feature;

use App\Helpers\Qs;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PhotoRemovalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** @test */
    public function user_can_remove_custom_photo_and_revert_to_default()
    {
        // Create a user with a custom photo
        $user = User::factory()->create([
            'photo' => 'storage/uploads/custom_photo.jpg'
        ]);

        // Create a fake uploaded file in storage
        Storage::disk('public')->put('uploads/custom_photo.jpg', 'fake image content');

        // Act as the user and remove photo
        $response = $this->actingAs($user)
            ->delete(route('my_account.remove_photo'));

        // Assert the response
        $response->assertRedirect();
        $response->assertSessionHas('flash_success');

        // Assert the user's photo is set back to default
        $user->refresh();
        $this->assertEquals(Qs::getDefaultUserImage(), $user->photo);

        // Assert the custom photo file was deleted from storage
        Storage::disk('public')->assertMissing('uploads/custom_photo.jpg');
    }

    /** @test */
    public function user_cannot_remove_default_photo()
    {
        // Create a user with default photo
        $user = User::factory()->create([
            'photo' => Qs::getDefaultUserImage()
        ]);

        // Act as the user and try to remove photo
        $response = $this->actingAs($user)
            ->delete(route('my_account.remove_photo'));

        // Assert the response shows error
        $response->assertRedirect();
        $response->assertSessionHas('flash_danger');

        // Assert the user's photo remains the default
        $user->refresh();
        $this->assertEquals(Qs::getDefaultUserImage(), $user->photo);
    }

    /** @test */
    public function user_without_photo_cannot_remove_photo()
    {
        // Create a user without photo (null)
        $user = User::factory()->create([
            'photo' => null
        ]);

        // Act as the user and try to remove photo
        $response = $this->actingAs($user)
            ->delete(route('my_account.remove_photo'));

        // Assert the response shows error
        $response->assertRedirect();
        $response->assertSessionHas('flash_danger');

        // Assert the user's photo remains null
        $user->refresh();
        $this->assertNull($user->photo);
    }

    /** @test */
    public function photo_removal_handles_missing_file_gracefully()
    {
        // Create a user with a custom photo path but no actual file
        $user = User::factory()->create([
            'photo' => 'storage/uploads/missing_photo.jpg'
        ]);

        // Don't create the file in storage (simulate missing file)

        // Act as the user and remove photo
        $response = $this->actingAs($user)
            ->delete(route('my_account.remove_photo'));

        // Assert the response is successful even with missing file
        $response->assertRedirect();
        $response->assertSessionHas('flash_success');

        // Assert the user's photo is set back to default
        $user->refresh();
        $this->assertEquals(Qs::getDefaultUserImage(), $user->photo);
    }
}
