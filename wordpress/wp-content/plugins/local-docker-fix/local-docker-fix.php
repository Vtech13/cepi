<?php
/**
 * Plugin Name: Local Docker Fix
 * Description: Corrige les problèmes d'URLs en environnement Docker local
 * Version: 1.0
 * Author: Auto-generated
 */

// Empêcher l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

class LocalDockerFix {
    
    public function __construct() {
        add_action('wp_loaded', array($this, 'fix_urls'));
        add_filter('wp_get_attachment_url', array($this, 'fix_attachment_urls'));
        add_filter('stylesheet_uri', array($this, 'fix_stylesheet_urls'));
        add_filter('script_loader_src', array($this, 'fix_script_urls'));
        add_action('wp_head', array($this, 'add_url_fixes'));
    }
    
    /**
     * Corrige les URLs au chargement de WordPress
     */
    public function fix_urls() {
        // Force les bonnes URLs
        update_option('home', 'https://localhost:8443');
        update_option('siteurl', 'https://localhost:8443');
    }
    
    /**
     * Corrige les URLs des pièces jointes
     */
    public function fix_attachment_urls($url) {
        $old_domains = [
            'https://preprod-clinique-cepi.fr',
            'http://preprod-clinique-cepi.fr',
            'https://preprod.clinique-cepi.fr',
            'http://preprod.clinique-cepi.fr',
            'https://clinique-cepi.fr',
            'http://clinique-cepi.fr'
        ];
        
        foreach ($old_domains as $old_domain) {
            $url = str_replace($old_domain, 'https://localhost:8443', $url);
        }
        
        return $url;
    }
    
    /**
     * Corrige les URLs des feuilles de style
     */
    public function fix_stylesheet_urls($url) {
        return $this->fix_attachment_urls($url);
    }
    
    /**
     * Corrige les URLs des scripts
     */
    public function fix_script_urls($url) {
        return $this->fix_attachment_urls($url);
    }
    
    /**
     * Ajoute du JavaScript pour corriger les URLs côté client
     */
    public function add_url_fixes() {
        ?>
        <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Correction des URLs dans les @font-face
            var styles = document.getElementsByTagName('style');
            for (var i = 0; i < styles.length; i++) {
                var css = styles[i].innerHTML;
                css = css.replace(/https:\/\/preprod-clinique-cepi\.fr/g, 'https://localhost:8443');
                css = css.replace(/http:\/\/preprod-clinique-cepi\.fr/g, 'https://localhost:8443');
                css = css.replace(/https:\/\/preprod\.clinique-cepi\.fr/g, 'https://localhost:8443');
                css = css.replace(/http:\/\/preprod\.clinique-cepi\.fr/g, 'https://localhost:8443');
                css = css.replace(/https:\/\/clinique-cepi\.fr/g, 'https://localhost:8443');
                css = css.replace(/http:\/\/clinique-cepi\.fr/g, 'https://localhost:8443');
                styles[i].innerHTML = css;
            }
            
            // Correction des liens CSS externes
            var links = document.getElementsByTagName('link');
            for (var i = 0; i < links.length; i++) {
                if (links[i].rel === 'stylesheet' && links[i].href) {
                    var href = links[i].href;
                    href = href.replace(/https:\/\/preprod-clinique-cepi\.fr/g, 'https://localhost:8443');
                    href = href.replace(/http:\/\/preprod-clinique-cepi\.fr/g, 'https://localhost:8443');
                    href = href.replace(/https:\/\/preprod\.clinique-cepi\.fr/g, 'https://localhost:8443');
                    href = href.replace(/http:\/\/preprod\.clinique-cepi\.fr/g, 'https://localhost:8443');
                    href = href.replace(/https:\/\/clinique-cepi\.fr/g, 'https://localhost:8443');
                    href = href.replace(/http:\/\/clinique-cepi\.fr/g, 'https://localhost:8443');
                    if (href !== links[i].href) {
                        links[i].href = href;
                    }
                }
            }
        });
        </script>
        <?php
    }
}

// Initialiser le plugin
new LocalDockerFix();
?>
