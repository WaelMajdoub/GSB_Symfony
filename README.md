Projet GSB Symfony
========================

Procédure d'installation de l'application

```bash
composer install
```
```bash
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```

Ensuite aller sur la route 
/updateFHF


Explication : Le jeu d'essai est bien trop grand pour s'amuser à tout modifier en base de données, j'ai créé une route qui va faire les modifications voulues à ma place.

