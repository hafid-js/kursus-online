<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisteredUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_requires_name_email_and_password()
    {
        $response = $this->post(route('register'), []); // submit tanpa data

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_can_register_student_user()
    {
        Event::fake(); // Supaya event Registered tidak benar-benar jalan

        $response = $this->post(route('register'), [
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'type' => 'student',
        ]);

        $response->assertRedirect(route('verification.notice'));
        $this->assertDatabaseHas('users', [
            'email' => 'student@example.com',
            'role' => 'student',
            'approve_status' => 'pending',
        ]);

        $user = User::where('email', 'student@example.com')->first();
        $this->assertTrue(Hash::check('Password123!', $user->password));

        Event::assertDispatched(Registered::class);
        $this->assertAuthenticatedAs($user);
    }

    public function test_can_register_instructor_user_with_document_upload()
    {
        Event::fake();
        Storage::fake('public'); // Fake storage supaya file tidak benar-benar disimpan

        $file = UploadedFile::fake()->create('document.pdf', 500, 'application/pdf');

        $response = $this->post(route('register'), [
            'name' => 'Instructor User',
            'email' => 'instructor@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'type' => 'instructor',
            'document' => $file,
        ]);

        $response->assertRedirect(route('verification.notice'));

        $user = User::where('email', 'instructor@example.com')->first();

        $this->assertDatabaseHas('users', [
            'email' => 'instructor@example.com',
            'role' => 'instructor',
            'approve_status' => 'pending',
        ]);

        $this->assertNotNull($user->document);

        // Cek file benar-benar "diupload" ke storage fake
        Storage::disk('public')->assertExists($user->document);

        Event::assertDispatched(Registered::class);
        $this->assertAuthenticatedAs($user);
    }

    public function test_registration_with_invalid_type_aborts_404()
    {
        $response = $this->post(route('register'), [
            'name' => 'Invalid User',
            'email' => 'invalid@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'type' => 'admin', // tipe tidak valid
        ]);

        $response->assertStatus(404);
    }
}
