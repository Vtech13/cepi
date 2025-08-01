<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test qu'un utilisateur admin a accès à l'espace admin
     */
    public function test_admin_can_access_admin_panel()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);
        $response = $this->get('/admin');
        $response->assertStatus(200);
    }

    /**
     * Test qu'un utilisateur non admin est refusé
     */
    public function test_non_admin_cannot_access_admin_panel()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);
        $response = $this->get('/admin');
        $response->assertStatus(403);
    }
}
