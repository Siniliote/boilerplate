# Infection - PHP Mutation Testing Framework

---

> Un Framework de test basé sur les mutations

## Infection

Le principe en quelques lignes.

- Infection exécute vos tests en premier lieu.
- Grâce à eux, il va générer des mutants.
- Un mutant est une modification, très simple, de votre code. Grâce à ça, votre test va être rejoué avec cette modification.
- Si votre test est robuste, le mutant est tué !

## Installation

`make composer.require.dev infection/infection`

---

`composer require --dev infection/infection`

## Usage - Makefile

> .mk\12_quality-assurance.mk

Le lancement de l'infection peut être accèlérer en utilisant plus de processus ou le code coverage de phpunit

| Make                        | Description                                                                              | Commande                                                               |
| --------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------- |
| `qa.infection`              | Lancement de l'infection sur le projet en parallèle (option -j)                          | `php ./vendor/bin/infection -j4`                                       |
| `qa.infection.withcoverage` | Lancement de l'infection en utilisant le coverage XML de phpUnit si il a été lancé avant | `php ./vendor/bin/infection -j4 --coverage=build/phpunit/coverage-xml` |

## Fichier de configuration

> infection.json.dist

```json
{
    "source": {
        "directories": [
            "src"
        ]
    },
    "timeout": 10,
    "logs": {
        "text": "build/logs/infection/infection-log.txt",
        "summary": "build/logs/infection/summary-log.txt",
        "debug": "build/logs/infection/debug-log.txt"
    },
    "phpUnit": {
        "configDir": "."
    }
}
```

### Source

- [Github](https://github.com/infection/infection)
- [WebSite](https://infection.github.io/)
- [Conférence PHP Tour 2014](https://www.youtube.com/watch?v=jI6RRylkGiw)
- [Article](https://www.choosit.com/blog/fonctionnement-infection-php-framework-de-test/)
- [Article](https://alejandrocelaya.blog/2018/02/17/mutation-testing-with-infection-in-big-php-projects/)
