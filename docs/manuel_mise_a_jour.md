# Manuel de mise à jour

1. Récupérer les dernières modifications : `git pull`
2. Mettre à jour les dépendances :
   - Laravel : `docker-compose exec laravel composer install`
   - Node : `docker-compose exec laravel npm install && npm run prod`
   - WordPress : via l’interface admin
3. Appliquer les migrations si besoin : `docker-compose exec laravel php artisan migrate`
4. Redémarrer les services si nécessaire : `docker-compose restart`
