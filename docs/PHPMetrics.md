# PHPMetrics - PhpMetrics, analyseur statique pour PHP

---

> Des informations belles et lisibles sur votre code PHP

## PHPMetrics

PhpMetrics analyse votre code PHP et fournit des rapports HTML, JSON, CSV… sur la complexité, les dépendances, le couplage, les violations, et plus encore !

## Installation

`make composer.require.dev phpmetrics/phpmetrics`

---

`composer require --dev phpmetrics/phpmetrics`

## Usage - Makefile

> .mk\12_quality-assurance.mk

Le lancement de l'infection peut être accèlérer en utilisant plus de processus ou le code coverage de phpunit

| Make                        | Description                                                                              | Commande                                                               |
| --------------------------- | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------- |
| `qa.phpmetrics`             | Provide tons of metric (complexity / volume / object oriented / maintainability)                          | `php ./vendor/bin/phpmetrics --config=phpmetrics.json.dist`                                       |
| `qa.phpmetrics.open`        | Open metrics report.                          | |

## Fichier de configuration

> phpmetrics.json

```json
{
  "includes": [
    "src"
  ],
  "exclude": [
    "tests"
  ],
  "report": {
    "html": "build/phpmetrics/",
    "json": "build/logs/phpmetrics.json",
    "violations": "build/logs/phpmetrics-violations.xml"
  },
  "plugins": {
    "junit": {
      "file": "build/logs/junit.xml"
    }
  },
  "extensions": [ "php", "php8" ]
}
```

### Source

- [Github](https://github.com/phpmetrics/PhpMetrics)
- [WebSite](https://phpmetrics.github.io/PhpMetrics/)
- [Liste des metriques](https://github.com/phpmetrics/PhpMetrics/blob/master/doc/metrics.md)