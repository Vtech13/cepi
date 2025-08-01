<?php
/**
 * Plugin Name: Local Docker API Fix
 * Description: Corrige les problèmes d'API REST et de requêtes de bouclage en environnement Docker local
 * Version: 1.0
 */

// Empêcher l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

class LocalDockerApiFix {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_filter('rest_url', array($this, 'fix_rest_url'), 10, 2);
        add_filter('site_url', array($this, 'fix_internal_urls'), 10, 4);
        add_filter('home_url', array($this, 'fix_internal_urls'), 10, 4);
    }
    
    public function init() {
        // Rien pour le moment
    }
    
    /**
     * Corrige les URLs REST API pour les requêtes internes
     */
    public function fix_rest_url($url, $path) {
        // Si c'est une requête interne (cron, API, etc.)
        if ($this->is_internal_request()) {
            $url = str_replace('https://localhost:8443', 'https://wordpress:443', $url);
        }
        return $url;
    }
    
    /**
     * Corrige les URLs du site pour les requêtes internes
     */
    public function fix_internal_urls($url, $path, $scheme, $blog_id) {
        // Si c'est une requête interne (cron, API, etc.)
        if ($this->is_internal_request()) {
            $url = str_replace('https://localhost:8443', 'https://wordpress:443', $url);
        }
        return $url;
    }
    
    /**
     * Détecte si c'est une requête interne
     */
    private function is_internal_request() {
        // Vérifier si c'est une requête cron
        if (defined('DOING_CRON') && DOING_CRON) {
            return true;
        }
        
        // Vérifier si c'est WP-CLI
        if (defined('WP_CLI') && WP_CLI) {
            return true;
        }
        
        // Vérifier le User-Agent
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        if (strpos($user_agent, 'WordPress') !== false) {
            return true;
        }
        
        // Vérifier si c'est une requête REST API interne
        if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'wp-json') !== false) {
            // Si la requête vient de localhost (requête interne), la rediriger
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            if (strpos($referer, 'localhost:8443') !== false || empty($referer)) {
                return true;
            }
        }
        
        return false;
    }
}

// Initialiser le plugin
new LocalDockerApiFix();
?>
