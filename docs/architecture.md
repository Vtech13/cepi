# Architecture logicielle

Le projet est structuré en microservices Docker :
- **Laravel** : Backend API, logique métier, authentification
- **WordPress** : CMS pour la gestion de contenu
- **MySQL** : Base de données

## Structure Laravel
- `app/` : Code métier (contrôleurs, modèles, services)
- `routes/` : Définition des routes
- `resources/` : Vues et assets
- `tests/` : Tests unitaires et fonctionnels

## Maintenabilité
- Respect du principe SOLID
- Découplage des composants
- Utilisation de design patterns (Repository, Service, etc.)
