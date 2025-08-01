# Architecture logicielle

Le projet est structuré en microservices Docker :
- **Laravel** : Backend API, logique métier, authentification, gestion des utilisateurs et des rôles, API REST pour l’application et le front.
- **WordPress** : CMS pour la gestion de contenu éditorial (pages, articles, médias), accessible via /wordpress.
- **MySQL** : Base de données partagée, avec schémas séparés pour Laravel et WordPress.

## Schéma global

```
[Client Web/Mobile]
      |
[NGINX Proxy SSL]
      |
[Laravel API] <--> [MySQL] <--> [WordPress]
```

## Structure Laravel
- `app/Http/Controllers/` : Contrôleurs REST, gestion des accès, logique métier
- `app/Models/` : Modèles Eloquent (User, Article, etc.)
- `app/Repositories/` : Accès aux données, logique métier réutilisable
- `routes/` : Définition des routes (web, api, admin)
- `resources/views/` : Vues Blade pour l’admin
- `resources/lang/` : Fichiers de traduction (FR/EN)
- `tests/` : Tests unitaires et fonctionnels (PHPUnit)

## Structure WordPress
- `wp-content/themes/` : Thème custom pour l’intégration graphique
- `wp-content/plugins/` : Plugins maison pour l’intégration avec Laravel (auth, API, etc.)

## Maintenabilité
- Respect du principe SOLID (Single Responsibility, etc.)
- Découplage des composants (services, repositories, middlewares)
- Utilisation de design patterns (Repository, Service, Observer)
- Documentation du code (PHPDoc, README)
- CI/CD pour garantir la qualité et la non-régression

## Sécurité & évolutivité
- Authentification centralisée (Sanctum)
- Gestion fine des rôles et permissions
- API versionnée pour permettre l’évolution sans rupture
- Séparation des environnements (dev, staging, prod)

## Accessibilité
- Respect des standards d’accessibilité dans les vues Laravel et le thème WordPress
- Tests manuels et automatiques sur les interfaces
