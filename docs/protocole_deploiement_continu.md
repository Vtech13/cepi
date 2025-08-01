# Protocole de déploiement continu

Ce document décrit le pipeline CI/CD utilisé pour garantir la livraison continue du projet.

## Outils utilisés
- GitHub Actions (ou GitLab CI)
- Docker
- Laravel Envoyer (optionnel)

## Étapes du pipeline
1. **Lint & Tests** : Lancement automatique des tests unitaires et de l’analyse statique à chaque push.
2. **Build** : Construction des images Docker pour chaque service (Laravel, WordPress, MySQL).
3. **Déploiement** : Déploiement automatique sur l’environnement de staging, puis production après validation.

## Sécurité
- Les secrets sont stockés dans les variables d’environnement du pipeline.
- Les accès sont restreints par clé SSH et tokens.
