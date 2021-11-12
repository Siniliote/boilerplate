# PHPUnit

---

> PHPUnit est un outil permettant de faire des tests

## Installation

`make composer.require.dev symfony/phpunit-bridge`

---

`composer require --dev symfony/phpunit-bridge`

## Usage - Makefile

> .mk\08_phpunit.mk

| Make                          | Description                                                              | Commande                               |
| ----------------------------- | ------------------------------------------------------------------------ | -------------------------------------- |
| `phpunit`                     | Permet de lancer tous les tests unitaires et fonctionnels                | `php ./vendor/bin/phpstan analyze`     |
| `phpunit.coverage`            | Génère le code coverage en HTML pour les tests unitaires et fonctionnels | `php ./vendor/bin/phpstan analyze`     |
| `phpunit.coverage.open`       | Permet d'ouvrir le code coverage HTML dans votre navigateur par défaut   | `php ./vendor/bin/phpstan analyze`     |
| `phpunit.unit`                | Permet de lancer tous les tests unitaires                                | `php ./vendor/bin/phpstan analyze`     |
| `phpunit.unit.coverage`       | Génère le code coverage en HTML pour les tests unitaires                 | `php ./vendor/bin/phpstan analyze`     |
| `phpunit.functional`          | Permet de lancer tous les tests fonctionnels                             | `php ./vendor/bin/phpstan analyze`     |
| `phpunit.functional.coverage` | Génère le code coverage en HTML pour les tests fonctionnels              | `php ./vendor/bin/phpstan analyze`     |

## Fichier de configuration

> .phpunit.xml.dist

```xml
<?xml version="1.0" encoding="UTF-8"?>

<!-- https://phpunit.readthedocs.io/en/latest/configuration.html -->
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" cacheResultFile="build/cache/.phpunit.result.cache" xsi:noNamespaceSchemaLocation="vendor/bin/.phpunit/phpunit-9.5-0/phpunit.xsd" backupGlobals="false" colors="true" bootstrap="tests/bootstrap.php" convertDeprecationsToExceptions="true">
    <php>
        <ini name="display_errors" value="1" />
        <ini name="error_reporting" value="-1" />
        <server name="APP_ENV" value="test" force="true" />
        <server name="SHELL_VERBOSITY" value="-1" />
        <server name="SYMFONY_PHPUNIT_REMOVE" value="" />
        <server name="SYMFONY_PHPUNIT_VERSION" value="9.5" />
    </php>

    <testsuites>
        <testsuite name="unit">
            <directory>tests/Unit</directory>
        </testsuite>
        <testsuite name="functional">
            <directory>tests/Functional</directory>
        </testsuite>
    </testsuites>

    <coverage processUncoveredFiles="true">
        <include>
            <directory suffix=".php">src</directory>
        </include>
        <exclude>
            <directory>src/Migrations</directory>
        </exclude>
    </coverage>

    <listeners>
        <listener class="Symfony\Bridge\PhpUnit\SymfonyTestsListener" />
    </listeners>

    <!-- Run `composer require symfony/panther` before enabling this extension -->
    <!--
    <extensions>
        <extension class="Symfony\Component\Panther\ServerExtension" />
    </extensions>
    -->
</phpunit>
```

### Source

- [Site officiel](https://phpunit.de/)
- [Github](https://github.com/symfony/phpunit-bridge)
