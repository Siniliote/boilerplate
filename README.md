# Boilerplate
=============

Standard ; se dit pour un texte (boilerplate text), une fonctionnalité d'un programme informatique dont le code source est quasiment le même quel que soit le programme (boilerplate code). Rapidement ceux projet à pour utilité de mettre en avant des standards pour la nouvelle structure de projet à venir.

Pré-requis
------------

  * Docker
  * Make

Contenu Docker
--------------

  * PHP 8.0-fpm-alpine
  * Nginx 1.21.3-alpine
  * APCU 5.1.21
  * XDebug 3.1.1
  * PostgreSql 13-alpine

Installation
------------

Pour effectuer l'installation du projet, lancer la commande ci-dessous, 
Etape de l'installation : 
 - Install hook pre-commit
 - Démarrage du docker 
 - Install des dépendances
 - Install de la base de données
 - Install des fixtures
 - Clean cache
 - Affichage des infos

```bash
  $ make install
```

Commande utiles
---------------


Tests
-----

Exécutez cette commande pour exécuter des tests :

```bash
$ make tests
```

Pour obtenir la couverture de code phpunit :

```bash
$ make phpunit.coverage
```



Documentations
- [Makefile](docs/Makefile.md)
- [Docker](docs/Docker.md)
- [PHP CS Fixer](docs/PHPCsFixer.md)
- [PHPStan](docs/PHPStan.md)
- [Infection](docs/Infection.md)
- [PHPUnit](docs/PHPUnit.md)
- [Swagger](docs/Swagger.md)
