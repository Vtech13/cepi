# Système de supervision

## Outils utilisés
- **Laravel** : logs centralisés (fichiers, Sentry)
- **WordPress** : logs PHP, plugin de monitoring (Query Monitor)
- **UptimeRobot** : surveillance de la disponibilité HTTP(S)
- **Alertes** : email en cas d’erreur critique ou d’indisponibilité

## Indicateurs suivis
- Taux d’erreurs 500/404
- Temps de réponse moyen
- Espace disque serveur
- Nombre d’utilisateurs actifs
- Disponibilité des services (API, site public, admin)

## Modalités de signalement
- Alertes automatiques par email ou Slack
- Dashboard de suivi (Grafana, Sentry)
- Rapport hebdomadaire envoyé à l’équipe
