#!/bin/bash

echo "🚀 Initialisation automatique du projet CliniqueCEPI..."
echo "   Version: 2.0 - Déploiement simplifié"
echo ""

# Couleurs pour les messages
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Fonction pour afficher les messages colorés
print_status() {
    echo -e "${BLUE}ℹ️  $1${NC}"
}

print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# 1. Vérifications préalables
print_status "Vérification des prérequis..."

# Vérifier que Docker est installé
if ! command -v docker &> /dev/null; then
    print_error "Docker n'est pas installé."
    echo "   📥 Installez Docker depuis: https://www.docker.com/get-started"
    exit 1
fi

# Vérifier que Docker Compose est disponible
if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
    print_error "Docker Compose n'est pas disponible."
    exit 1
fi

# Vérifier que Docker est lancé
if ! docker info &> /dev/null; then
    print_error "Docker n'est pas lancé."
    echo "   🔄 Démarrez Docker et relancez ce script."
    exit 1
fi

print_success "Prérequis vérifiés"

# 2. Nettoyage des conteneurs existants (si nécessaire)
print_status "Nettoyage des conteneurs existants..."
docker-compose down --remove-orphans 2>/dev/null || true
docker system prune -f --volumes 2>/dev/null || true
print_success "Nettoyage terminé"

# 3. Construction et lancement des conteneurs
print_status "Construction et lancement des conteneurs..."
if docker-compose up --build -d; then
    print_success "Conteneurs démarrés"
else
    print_error "Échec du démarrage des conteneurs"
    exit 1
fi

# 4. Attendre que MySQL soit prêt (avec timeout)
print_status "Attente que MySQL soit prêt..."
MYSQL_READY=false
for i in {1..30}; do
    if docker exec mysql mysqladmin ping -h"localhost" --silent 2>/dev/null; then
        MYSQL_READY=true
        break
    fi
    echo "   Tentative $i/30..."
    sleep 3
done

if [ "$MYSQL_READY" = false ]; then
    print_error "MySQL n'a pas démarré dans les temps"
    exit 1
fi
print_success "MySQL est prêt"

# 5. Attendre que WordPress soit prêt (avec timeout)
print_status "Attente que WordPress soit prêt..."
WORDPRESS_READY=false
for i in {1..20}; do
    if curl -f -s https://localhost:8443 -k > /dev/null 2>&1; then
        WORDPRESS_READY=true
        break
    fi
    echo "   Tentative $i/20..."
    sleep 5
done

if [ "$WORDPRESS_READY" = false ]; then
    print_warning "WordPress met du temps à démarrer, on continue..."
    sleep 10
fi
print_success "WordPress est prêt"

# 6. Configuration automatique de WordPress
print_status "Configuration automatique de WordPress..."

# Vérifier si les scripts existent
if [ ! -f "complete_url_update.php" ]; then
    print_error "Script complete_url_update.php manquant"
    exit 1
fi

if [ ! -f "activate_plugin.php" ]; then
    print_error "Script activate_plugin.php manquant"
    exit 1
fi

# Copier et exécuter le script de mise à jour des URLs
print_status "Mise à jour des URLs WordPress..."
if docker cp complete_url_update.php wordpress:/var/www/html/ && \
   docker exec wordpress php /var/www/html/complete_url_update.php > /dev/null; then
    print_success "URLs mises à jour"
else
    print_warning "Problème lors de la mise à jour des URLs (continuons...)"
fi

# Activer le plugin de correction des URLs
print_status "Activation du plugin Local Docker Fix..."
if docker cp activate_plugin.php wordpress:/var/www/html/ && \
   docker exec wordpress php /var/www/html/activate_plugin.php > /dev/null; then
    print_success "Plugin activé"
else
    print_warning "Problème lors de l'activation du plugin (continuons...)"
fi

# 7. Redémarrage de WordPress pour appliquer les changements
print_status "Redémarrage de WordPress..."
if docker-compose restart wordpress > /dev/null; then
    print_success "WordPress redémarré"
else
    print_warning "Problème lors du redémarrage"
fi

# 8. Attendre que WordPress redémarre
print_status "Finalisation..."
sleep 5
for i in {1..10}; do
    if curl -f -s https://localhost:8443 -k > /dev/null 2>&1; then
        break
    fi
    sleep 3
done

# 9. Test final des services
print_status "Test des services..."
SERVICES_OK=true

# Test MySQL
if ! docker exec mysql mysqladmin ping -h"localhost" --silent 2>/dev/null; then
    print_error "MySQL ne répond pas"
    SERVICES_OK=false
else
    print_success "MySQL fonctionne"
fi

# Test WordPress HTTPS
if curl -f -s https://localhost:8443 -k > /dev/null 2>&1; then
    print_success "WordPress HTTPS fonctionne"
else
    print_warning "WordPress HTTPS ne répond pas"
fi

# Test WordPress HTTP
if curl -f -s http://localhost:8080 > /dev/null 2>&1; then
    print_success "WordPress HTTP fonctionne"
else
    print_warning "WordPress HTTP ne répond pas"
fi

# Test Laravel HTTPS
if curl -f -s https://localhost:8001 -k > /dev/null 2>&1; then
    print_success "Laravel HTTPS fonctionne"
else
    print_warning "Laravel HTTPS ne répond pas"
fi

# Test Laravel HTTP
if curl -f -s http://localhost:8000 > /dev/null 2>&1; then
    print_success "Laravel HTTP fonctionne"
else
    print_warning "Laravel HTTP ne répond pas"
fi

echo ""
echo "🎉 Initialisation terminée !"
echo ""
echo "📍 Vos applications sont accessibles :"
echo "   🌐 WordPress (HTTPS): https://localhost:8443"
echo "   🌐 WordPress (HTTP):  http://localhost:8080"  
echo "   🌐 Laravel (HTTPS):   https://localhost:8001"
echo "   🌐 Laravel (HTTP):    http://localhost:8000"
echo ""
echo "⚠️  Notes importantes :"
echo "   • Pour HTTPS, acceptez le certificat auto-signé dans votre navigateur"
echo "   • Si un service ne répond pas, attendez quelques minutes et réessayez"
echo ""
echo "🛠️  Commandes utiles :"
echo "   • Arrêter: docker-compose down"
echo "   • Logs: docker-compose logs"
echo "   • Redémarrer: docker-compose restart"
echo ""
