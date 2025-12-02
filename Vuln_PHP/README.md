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
php bin/console d:d:c && 
php bin/console d:s:u --force &&
php bin/console d:f:l &&
npm i && 
npm run dev
```
*Écrire `yes` quand c’est demandé.*

Quitter le conteneur avec `exit`.


1. Vous pouvez créer un compte sur chaque application :
    - http://localhost/
