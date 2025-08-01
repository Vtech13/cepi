# Accessibilité

## Principes appliqués
- Respect des standards RGAA/WCAG 2.1 AA sur toutes les pages Laravel et WordPress
- Navigation clavier complète (tabulation logique, focus visible)
- Contrastes vérifiés (>4.5:1) sur tous les textes et boutons
- Utilisation d’attributs ARIA pour les composants dynamiques (menus, modales)
- Formulaires accessibles : labels explicites, messages d’erreur lisibles, champs obligatoires signalés

## Outils utilisés
- Extension Wave, axe DevTools pour l’audit accessibilité
- Tests manuels avec NVDA/VoiceOver
- Vérification automatique via CI (pa11y, axe-core)

## Actions spécifiques
- Thème WordPress custom conforme RGAA (navigation, couleurs, structure sémantique)
- Composants Laravel (boutons, alertes, modales) testés au clavier et avec lecteur d’écran
- Documentation interne sur les bonnes pratiques d’accessibilité pour les développeurs et contributeurs

## Recette accessibilité
- Scénarios de test dans le cahier de recette (navigation sans souris, lecture des messages d’erreur, etc.)
- Correction continue des retours utilisateurs en situation de handicap
