# 🏥 Clinique CEPI - Projet Docker

Projet WordPress + Laravel avec SSL automatique pour environnement de développement.

## 🚀 Installation ultra-simple

### Prérequis
- Docker Desktop installé et démarré
- Ports 8000, 8001, 8080, 8443, 3306 disponibles

### Installation en 1 commande

```bash
chmod +x init-project.sh && ./init-project.sh
```

C'est tout ! ✨

## 📍 URLs d'accès

Une fois l'installation terminée :

- **Site web** : https://localhost:8443 ⭐

## 🔐 Certificats SSL

Le projet génère automatiquement des certificats SSL auto-signés. 

**⚠️ Première fois** : Votre navigateur affichera un avertissement de sécurité.
- Cliquez sur "Avancé" puis "Continuer vers localhost"
- C'est normal pour le développement local !

## 🛠️ Scripts d'automatisation

### Scripts principaux
```bash
# 🚀 Installation complète (première fois uniquement)
./init-project.sh
# ➤ Nettoie, build, lance, migre les URLs, active les plugins, teste

# ▶️ Démarrage rapide (usage quotidien)
./start-project.sh
# ➤ Lance les conteneurs existants

# ⏹️ Arrêt propre
./stop-project.sh
# ➤ Arrête tous les conteneurs sans supprimer les données
```

### Commandes Docker utiles
```bash
# 📋 Voir les logs
docker-compose logs
docker-compose logs -f wordpress    # Suivre les logs WordPress

# 🔄 Redémarrer un service
docker-compose restart wordpress
docker-compose restart laravel

# 📊 État des conteneurs
docker-compose ps

# 🧹 Nettoyage complet (⚠️ supprime toutes les données)
docker-compose down --volumes --remove-orphans
```

## 📁 Structure du projet

```
cepi/
├── init-project.sh          # 🚀 Script d'installation automatique
├── start-project.sh         # ▶️ Démarrage rapide
├── stop-project.sh          # ⏹️ Arrêt propre
├── docker-compose.yml       # Configuration Docker
├── docker/                  # Configurations Docker
│   ├── wordpress/           # Configuration WordPress + SSL
│   └── laravel/             # Configuration Laravel + SSL
├── wordpress/               # Fichiers WordPress
│   └── wp-content/plugins/local-docker-fix/  # Plugin de correction d'URLs
├── main/                    # Fichiers Laravel
└── *.php                    # Scripts de migration automatique
```

## 📦 Déploiement sur nouvel ordinateur

### Option 1 : Depuis Git (recommandé)
```bash
# Cloner le projet
git clone https://github.com/Vtech13/cepi/
cd cepi

# Lancer l'installation
chmod +x init-project.sh && ./init-project.sh
```

### Option 2 : Copie manuelle
1. Copiez le dossier complet `cepi/`
2. Lancez : `chmod +x init-project.sh && ./init-project.sh`
3. C'est tout ! 🎉

## 🔒 Informations techniques

- **WordPress** : PHP 8.1 + Apache + SSL
- **Laravel** : PHP 8.1 + Apache + SSL  
- **MySQL** : 8.0
- **Certificats** : Auto-signés, générés automatiquement
- **Environnement** : Docker Compose

---

*Développé pour un déploiement simple et rapide* ⚡

# Projet Laravel & WordPress – Dossier Bloc 2

## Structure du dossier
- Code source Laravel : `main/`
- Code source WordPress : `wordpress/`
- Docker : `docker/`
- Documentation : `docs/`

## Documentation Bloc 2
- [Protocole de déploiement continu](docs/protocole_deploiement_continu.md)
- [Critères de qualité et de performance](docs/qualite_performance.md)
- [Protocole d’intégration continue](docs/protocole_integration_continue.md)
- [Architecture logicielle](docs/architecture.md)
- [Prototype](docs/prototype.md)
- [Frameworks et paradigmes](docs/framework_paradigmes.md)
- [Sécurité](docs/securite.md)
- [Accessibilité](docs/accessibilite.md)
- [Historique des versions](docs/historique_versions.md)
- [Cahier de recettes](docs/cahier_recette.md)
- [Plan de correction des bogues](docs/plan_correction_bogues.md)
- [Manuel de déploiement](docs/manuel_deploiement.md)
- [Manuel d’utilisation](docs/manuel_utilisation.md)
- [Manuel de mise à jour](docs/manuel_mise_a_jour.md)

## Documentation Bloc 4 (maintenance & supervision)
- [Mise à jour des dépendances](docs/bloc4/maj_dependances.md)
- [Système de supervision](docs/bloc4/supervision.md)
- [Collecte et consignation des anomalies](docs/bloc4/collecte_anomalies.md)
- [Fiche d’anomalie rencontrée](docs/bloc4/fiche_anomalie.md)
- [Traitement d’une anomalie détectée](docs/bloc4/traitement_anomalie.md)
- [Recommandations d’amélioration](docs/bloc4/recommandations.md)
- [Journal de version](docs/bloc4/journal_version.md)
- [Exemple de problème résolu avec le support client](docs/bloc4/support_client.md)

## Lancer les tests unitaires

```bash
cd main
php artisan test
```

## Fonctionnalités testées
- Sécurité (voir `tests/Unit/SecurityTest.php`)
- Création d’utilisateur (voir `tests/Unit/UserCreationTest.php`)

## Accessibilité et sécurité
Voir les sections dédiées dans la documentation.

## Contact
Pour toute question, voir le manuel d’utilisation ou contacter l’équipe projet.
