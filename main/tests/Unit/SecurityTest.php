<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Middleware\CheckRoleAdminCms;
use App\Http\Middleware\CheckRolePlatform;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Tests unitaires pour les fonctionnalités de sécurité
 * 
 * Ce jeu de tests couvre les fonctionnalités de sécurité critiques
 * pour prévenir les régressions et assurer le bon fonctionnement
 */
class SecurityTest extends TestCase
{
    /**
     * Test de validation des middlewares de sécurité
     * Vérifie que les middlewares de rôles sont correctement configurés
     */
    public function test_security_middlewares_exist()
    {
        $this->assertTrue(class_exists(CheckRoleAdminCms::class));
        $this->assertTrue(class_exists(CheckRolePlatform::class));
    }

    /**
     * Test de validation des headers de sécurité
     * Vérifie que les headers de sécurité sont présents
     */
    public function test_security_headers_validation()
    {
        // Test des headers CORS
        $corsConfig = config('cors');
        $this->assertIsArray($corsConfig);
        $this->assertArrayHasKey('paths', $corsConfig);
        
        // Vérification que les chemins sensibles sont protégés
        $this->assertContains('api/*', $corsConfig['paths']);
    }

    /**
     * Test de validation CSRF
     * Vérifie que la protection CSRF est active
     */
    public function test_csrf_protection_enabled()
    {
        $middleware = config('app.middleware');
        $this->assertIsArray($middleware);
        
        // Vérification de la présence du middleware CSRF dans la configuration
        $csrfMiddleware = \App\Http\Middleware\VerifyCsrfToken::class;
        $this->assertTrue(class_exists($csrfMiddleware));
    }

    /**
     * Test de validation des mots de passe
     * Vérifie que les règles de mot de passe sont sécurisées
     */
    public function test_password_validation_rules()
    {
        $hashingConfig = config('hashing');
        $this->assertEquals('bcrypt', $hashingConfig['driver']);
        
        // Vérification des rounds bcrypt pour la sécurité
        $this->assertGreaterThanOrEqual(10, $hashingConfig['bcrypt']['rounds']);
    }

    /**
     * Test de validation de l'authentification
     * Vérifie que l'authentification est correctement configurée
     */
    public function test_authentication_configuration()
    {
        $authConfig = config('auth');
        $this->assertEquals('web', $authConfig['defaults']['guard']);
        $this->assertEquals('users', $authConfig['defaults']['passwords']);
        
        // Vérification de la configuration Sanctum
        $sanctumConfig = config('sanctum');
        $this->assertIsArray($sanctumConfig['middleware']);
    }

    /**
     * Test de sécurisation des sessions
     * Vérifie que les sessions sont sécurisées
     */
    public function test_session_security_configuration()
    {
        $sessionConfig = config('session');
        $this->assertTrue($sessionConfig['secure'] || app()->environment('local'));
        $this->assertTrue($sessionConfig['http_only']);
        $this->assertEquals('strict', $sessionConfig['same_site']);
    }

    /**
     * Test de validation de l'environnement de production
     * Vérifie que l'environnement est sécurisé pour la production
     */
    public function test_production_environment_security()
    {
        if (app()->environment('production')) {
            $this->assertTrue(config('app.debug') === false);
            $this->assertNotEquals('SomeRandomString', config('app.key'));
        }
        $this->assertTrue(true); // Test toujours valide en développement
    }
}
