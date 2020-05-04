# Location de vancances

## Description du projet
Apartment Dream Trip est un site de location et de réservation de logements entre particuliers.

## Pré-requis
Le site est développé avec Symfony 5
* PHP >= 7.1
* MySQL > 5.7

## Installation
Récupérer les sources du projet :
```
$ git clone git@github.com:ZAmararene/apartment-dream-trip.git
```

Installer les dépendances:
```
$ composer install
```

Configurer la connexion à la base de donnée dans le ficher :
```
$ .env
```

Créer la base de données :
```
$ php bin/console doctrine:database:create
```

Migrer les tables dans la base de données :
```
$ php bin/console doctrine:migrations:migrate
```

Charger les fixtures dans la base de données :
```
$ php bin/console doctrine:fixtures:load
```

Lancer le serveur :
```
$ symfony serve -d
```
