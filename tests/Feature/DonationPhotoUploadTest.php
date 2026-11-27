<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DonationPhotoUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_pendonasi_can_upload_food_photo()
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'role' => 'pendonasi',
            'status' => 'verified',
        ]);

        $file = UploadedFile::fake()->image('makanan-test.jpg', 600, 600);

        $response = $this->actingAs($user)->post(route('pendonasi.donations.store'), [
            'title' => 'Nasi Kotak Ayam Bakar',
            'food_type' => 'Makanan Berat',
            'quantity' => '20 Porsi',
            'delivery_method' => 'Ambil Sendiri',
            'deadline' => now()->addHours(12)->format('Y-m-d\TH:i'),
            'location' => 'Laguboti',
            'pickup_address' => 'Jl. IT Del No. 1',
            'pic_name' => 'Jundhy',
            'pic_contact' => '08123456789',
            'description' => 'Ayam bakar hangat dan bersih',
            'photo' => $file,
        ]);

        $response->assertRedirect(route('pendonasi.dashboard'));
        $this->assertDatabaseHas('donations', [
            'title' => 'Nasi Kotak Ayam Bakar',
            'user_id' => $user->id,
        ]);

        $donation = Donation::first();
        $this->assertNotNull($donation->image_url ?: $donation->photo);

        $path = $donation->image_url ?: $donation->photo;
        Storage::disk('public')->assertExists($path);
    }
}
