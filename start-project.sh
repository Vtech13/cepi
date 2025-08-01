#!/bin/bash

echo "⚡ Démarrage rapide du projet CliniqueCEPI..."

# Couleurs
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m'

# Vérifier que Docker fonctionne
if ! docker info &> /dev/null; then
    echo "❌ Docker n'est pas lancé. Démarrez Docker et relancez."
    exit 1
fi

# Démarrer les conteneurs existants
echo -e "${BLUE}🚀 Démarrage des conteneurs...${NC}"
docker-compose up -d

echo -e "${GREEN}✅ Démarrage terminé !${NC}"
echo ""
echo "📍 Applications accessibles :"
echo "   🌐 WordPress: https://localhost:8443"
echo "   🌐 Laravel:   https://localhost:8001"
