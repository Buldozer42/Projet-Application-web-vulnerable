Lancer :
```bash
docker compose build
docker compose up -d
```

Il faut après remplir la base de données, pour cela, entrer dans l’image `vulnerable-symfony-php` en lançant :
```bash
docker compose exec -it vulnerable-symfony-php bash
```

Une fois dans l’image, copier le paragraphe complet des commandes suivantes qui vont se lancer en une fois :
```bash
composer require --dev doctrine/doctrine-fixtures-bundle &&
composer install &&
php bin/console doctrine:database:create && 
php bin/console doctrine:schema:update --force &&
php bin/console doctrine:fixtures:load --no-interaction
npm i && 
npm run build
```
*Écrire `yes` quand c’est demandé.*

Quitter le conteneur avec `exit`.


1. Vous pouvez créer un compte sur chaque application :
    - http://localhost/
