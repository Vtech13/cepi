# Mesures de sécurité mises en œuvre

## Authentification et gestion des accès
- Authentification forte via Laravel Sanctum (API tokens, cookies sécurisés)
- Gestion des rôles et permissions (admin, éditeur, utilisateur simple) via middlewares personnalisés
- Accès restreint à l’admin Laravel et WordPress selon le rôle

## Protection des données et des sessions
- Hashage des mots de passe avec bcrypt (paramétrage des rounds)
- Sécurisation des sessions (cookies httpOnly, secure, SameSite=strict)
- Chiffrement des données sensibles dans la base

## Sécurité applicative
- Protection CSRF sur tous les formulaires Laravel
- Validation stricte des entrées utilisateurs (form requests, validation côté serveur)
- Protection XSS : échappement systématique dans les vues, désactivation de l’upload de scripts
- Headers de sécurité : CORS, HSTS, X-Frame-Options, X-Content-Type-Options

## Sécurité du déploiement
- Variables d’environnement dans `.env` (jamais versionnées)
- Accès SSH restreint, clés déployées via CI/CD
- Mises à jour régulières des dépendances (composer, npm, plugins WP)

## Surveillance et audit
- Logs centralisés (fichiers, Sentry, etc.)
- Alertes sur les erreurs critiques
- Revue de code systématique et analyse statique (PHPStan, SonarQube)

## Tests de sécurité
- Tests unitaires sur les middlewares et la configuration (voir `tests/Unit/SecurityTest.php`)
- Scénarios de recette pour les accès non autorisés et la gestion des sessions
