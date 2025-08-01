#!/bin/bash

echo "🛑 Arrêt du projet CliniqueCEPI..."

# Couleurs
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

# Arrêter et supprimer les conteneurs
echo -e "${YELLOW}📦 Arrêt des conteneurs...${NC}"
docker-compose down --remove-orphans

# Optionnel : supprimer les volumes (décommentez si vous voulez tout nettoyer)
# echo -e "${YELLOW}🗑️  Suppression des volumes...${NC}"
# docker-compose down --volumes --remove-orphans

echo -e "${GREEN}✅ Projet arrêté avec succès !${NC}"
echo ""
echo "💡 Pour redémarrer : ./init-project.sh"
echo "🗑️  Pour tout nettoyer : docker-compose down --volumes --remove-orphans"
