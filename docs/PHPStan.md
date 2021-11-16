# PHPStan

---

> PhpStan est un outil d'analyse static du code, il va permettre de détecter les erreurs avant l'exécution réelle.

## Installation

`make composer.require.dev phpstan/phpstan-symfony`
`make composer.require.dev phpstan/extension-installer`

---

`composer require --dev phpstan/phpstan-symfony`
`composer require --dev phpstan/extension-installer`

## Usage - Makefile

> .mk\12_quality-assurance.mk

| Make                            | Description                                       | Commande                                                |
| ------------------------------- | ------------------------------------------------- | ------------------------------------------------------- |
| `qa.phpstan.analyze`            | Permet d'analyser les fichiers                    | `php ./vendor/bin/phpstan analyze`                      |
| `qa.phpstan.generate.baseline`  | Génere le baseline pour déclarer des faux positif | `php ./vendor/bin/phpstan analyze --generate-baseline`  |

## Fichier de configuration

> .phpstan.neon.dist

```yaml
parameters:
  symfony:
    container_xml_path: var/cache/dev/App_KernelDevDebugContainer.xml
  scanDirectories:
    - var/cache/dev/Symfony/Config
  level: max
  paths:
    - src
    - tests
  bootstrapFiles:
    - vendor/bin/.phpunit/phpunit/vendor/autoload.php
```

### Source

- [Site officiel](https://phpstan.org/)
- [Github](https://github.com/phpstan/phpstan-symfony)
- [Github](https://github.com/phpstan/extension-installer)
