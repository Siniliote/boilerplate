MAKE_S = $(MAKE) -s

USER_ID = $(shell id -u)
GROUP_ID = $(shell id -g)
NPROCS := 1
OS := $(shell uname)

PROJECT_ROOT = api
PROJECT_BUILD = build
PROJECT_SRC = src
PHPUNIT_COVERAGE = $(PROJECT_BUILD)/phpunit/coverage

URL_WEBSITE = http://localhost
URL_API = $(URL_WEBSITE):8088/api
URL_SWAGGER = $(URL_WEBSITE):8080/swagger
URL_ADMINER = $(URL_WEBSITE):8088

XDEBUG_INI = /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

SERVICE_APP = app
SERVICE_DB = db
DOCKER_NETWORK_DEFAULT_NAME = symfony-default


EXEC = docker-compose exec
ifdef NO_TTY
  EXEC = docker-compose exec -T
endif

EXEC_USER = $(EXEC) --user $(USER_ID):$(GROUP_ID)
EXEC_ROOT = $(EXEC) --user 0

EXEC_APP = $(EXEC) $(SERVICE_APP)
EXEC_APP_ROOT = $(EXEC_ROOT) $(SERVICE_APP)
EXEC_DB = $(EXEC) $(SERVICE_DB)

COMPOSER = $(EXEC_APP) composer
PHP = $(EXEC_APP) php
PHPUNIT = $(EXEC_APP) ./vendor/bin/simple-phpunit
PHPUNIT_WATCH = $(EXEC_APP) ./vendor/bin/phpunit-watcher watch
BEHAT = $(EXEC_APP) ./vendor/bin/behat
YARN = $(EXEC_APP) yarn

SYMFONY = $(PHP) bin/console

CODESNIFFER = $(PHP) ./vendor/bin/php-cs-fixer
PHPSTAN = $(PHP) ./vendor/bin/phpstan
PSALM = $(PHP) ./vendor/bin/psalm
PSALTER = $(PHP) ./vendor/bin/psalter
MESSDETECTOR = $(PHP) ./vendor/bin/phpmd
PHPMETRICS = $(PHP) ./vendor/bin/phpmetrics
INFECTION = $(PHP) ./vendor/bin/infection

SUPPORTED_COMMANDS =
