# Manuel de déploiement

1. Cloner le dépôt
2. Copier le fichier `.env.example` en `.env` et configurer les variables
3. Lancer `docker-compose up -d`
4. Exécuter les migrations Laravel : `docker-compose exec laravel php artisan migrate --seed`
5. Accéder à l’application via http://localhost

Pour la production, adapter les variables d’environnement et sécuriser les accès.
