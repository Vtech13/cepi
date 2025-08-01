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

- **WordPress HTTPS** : https://localhost:8443 ⭐
- **WordPress HTTP** : http://localhost:8080
- **Laravel HTTPS** : https://localhost:8001 ⭐  
- **Laravel HTTP** : http://localhost:8000
- **Base de données** : localhost:3306

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

## ⚙️ Automatisations intégrées

Le projet inclut plusieurs automatisations pour garantir un fonctionnement parfait :

### 🔄 Migration automatique des URLs
- `complete_url_update.php` : Remplace toutes les anciennes URLs par `https://localhost:8443`
- Gestion des données sérialisées WordPress (options, posts, meta)
- Correction spéciale pour Elementor et autres builders

### 🔌 Plugin WordPress intégré
- `local-docker-fix` : Corrige dynamiquement les URLs côté serveur et client
- Auto-activation lors de l'installation
- Gestion des requêtes AJAX et API REST

### 🛡️ Configuration SSL automatique
- Génération de certificats auto-signés
- Configuration Apache HTTPS
- Redirection HTTP vers HTTPS

## 🔧 Dépannage

### Le site ne charge pas ?
- Attendez 2-3 minutes (première installation)
- Vérifiez que Docker est démarré
- Relancez : `./init-project.sh`

### Erreur de port ?
- Vérifiez qu'aucun autre service n'utilise les ports 8000, 8001, 8080, 8443, 3306
- Arrêtez autres serveurs web locaux (MAMP, XAMPP, Apache local)

### Problème SSL ?
- Acceptez le certificat dans votre navigateur
- Ou utilisez les URLs HTTP (port 8080/8000)

### WordPress affiche encore les anciennes URLs ?
- Le script `init-project.sh` corrige automatiquement ce problème
- En cas de problème persistant, relancez l'installation complète

## ❓ FAQ

**Q: Puis-je modifier les ports ?**
R: Oui, éditez le `docker-compose.yml` et relancez `./init-project.sh`

**Q: Comment accéder à la base de données ?**
R: Host: `localhost`, Port: `3306`, User: `wordpress`, Password: `wordpress`

**Q: Le projet fonctionne-t-il hors ligne ?**
R: Oui, une fois les images Docker téléchargées

**Q: Puis-je utiliser un vrai domaine ?**
R: Oui, modifiez les scripts PHP et la configuration Apache

## 📦 Déploiement sur nouvel ordinateur

### Option 1 : Depuis Git (recommandé)
```bash
# Cloner le projet
git clone [URL_DU_REPO] cepi
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
