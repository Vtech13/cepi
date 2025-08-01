<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCreationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de la création d'un utilisateur
     */
    public function test_user_can_be_created()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
        $this->assertTrue(Hash::check('password123', $user->password));
    }
}
