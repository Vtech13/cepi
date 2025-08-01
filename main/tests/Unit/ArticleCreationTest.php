<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleCreationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de la création d'un article par un utilisateur authentifié
     */
    public function test_authenticated_user_can_create_article()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $article = Article::create([
            'title' => 'Nouveau test',
            'content' => 'Contenu de test',
            'user_id' => $user->id
        ]);
        $this->assertDatabaseHas('articles', [
            'title' => 'Nouveau test',
            'user_id' => $user->id
        ]);
    }

    /**
     * Test qu'un utilisateur non authentifié ne peut pas créer d'article
     */
    public function test_guest_cannot_create_article()
    {
        $response = $this->post('/articles', [
            'title' => 'Test',
            'content' => 'Contenu',
        ]);
        $response->assertRedirect('/login');
    }
}
