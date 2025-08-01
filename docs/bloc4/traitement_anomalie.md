# Traitement d’une anomalie détectée

## Exemple traité
- **Anomalie** : Erreur 500 lors de la création d’un article
- **Diagnostic** : Problème de validation sur le champ "titre" (null non géré)
- **Correction** : Ajout d’une règle de validation dans le contrôleur Laravel
- **Test** : Ajout d’un test unitaire pour la création d’article sans titre
- **Déploiement** : Correction validée sur staging, puis déployée en production
- **Suivi** : Aucun nouvel incident signalé depuis la correction
