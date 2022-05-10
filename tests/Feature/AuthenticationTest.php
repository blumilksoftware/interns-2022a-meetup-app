<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Blumilk\Meetup\Core\Models\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanRegister(): void
    {
        $this->get('/auth/register')
            ->assertOk();

        $this->post('/auth/register', [
            "name" => 'User',
            "email" => 'user@example.com',
            "password" => 'password',
            "password_confirmation" => 'password',
        ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas("users", [
            "name" => 'User',
            "email" => 'user@example.com',
        ]);
    }

    public function testRegisterDataIsRequired(): void
    {
        $this->post('/auth/register')
            ->assertInvalid([
                'name',
                'email',
                'password',
                'password_confirmation',
            ]);
    }

    public function testUserCanLogIn(): void
    {
        User::factory()->create([
            "email" => 'user@example.com',
            "password" => 'password',
        ]);

        $this->post('/auth/login', [
            "email" => 'user@example.com',
            "password" => 'password',
        ])
            ->assertSessionHasNoErrors();

        $this->assertAuthenticated();
    }

    public function testUserCanLogOut(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/auth/logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }
}
