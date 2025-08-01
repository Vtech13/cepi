# Plan de correction des bogues

## Procédure de gestion des bugs

1. **Signalement**
   - Le bug est signalé via une issue GitHub (ou GitLab) ou un formulaire interne accessible depuis l’application (menu "Support").
   - Le signalement doit inclure : description, capture d’écran, étapes de reproduction, gravité, environnement concerné (prod, test, local).

2. **Qualification**
   - Un membre de l’équipe vérifie la reproductibilité du bug et l’associe à une version.
   - Le bug est priorisé (bloquant, majeur, mineur) et assigné à un développeur.

3. **Correction**
   - Le développeur crée une branche dédiée (`fix/nom-bug`) et corrige le bug.
   - Un test unitaire ou fonctionnel est ajouté ou mis à jour pour éviter la régression.

4. **Revue de code**
   - La correction est relue par un autre membre de l’équipe (pull request obligatoire).
   - Vérification de la conformité aux standards et de la couverture de tests.

5. **Déploiement sur environnement de test**
   - La branche est fusionnée sur `develop` ou `staging`.
   - Les tests automatiques sont relancés (CI/CD).
   - Le bug est validé par le demandeur ou le PO.

6. **Déploiement en production**
   - Après validation, la correction est déployée sur la branche `main`.
   - Un tag de version est créé et l’historique des versions est mis à jour.

## Suivi et traçabilité
- Tous les bugs sont tracés dans l’historique des versions (`docs/historique_versions.md`).
- Un tableau de bord (GitHub Projects ou équivalent) permet de suivre l’état d’avancement.
- Les corrections majeures sont documentées dans le changelog.
