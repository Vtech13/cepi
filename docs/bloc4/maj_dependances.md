# Mise à jour des dépendances

## Processus
- **Laravel** :
  - Mise à jour via `composer update` (test en local, staging, puis production)
  - Vérification des changements majeurs dans `composer.lock`
  - Tests automatiques après chaque mise à jour
- **Node.js** :
  - Mise à jour via `npm update` puis `npm run build`
  - Vérification des éventuels breaking changes
- **WordPress** :
  - Mises à jour via l’interface admin (core, plugins, thèmes)
  - Sauvegarde avant chaque mise à jour
  - Vérification de la compatibilité des plugins
- **Automatisation** :
  - Utilisation possible de Dependabot (GitHub) pour les alertes de sécurité et les PR automatiques

## Fréquence
- Vérification hebdomadaire en développement
- Mises à jour de sécurité appliquées dès publication
