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


