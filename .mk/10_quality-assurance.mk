## QUALITY ASSURANCE - STATIC ANALYZERS

SUPPORTED_COMMANDS += qa.codesniffer.fix.files

.PHONY: qa.phpmetrics
qa.phpmetrics: _build ## PHPMetrics: Provide tons of metric (complexity / volume / object oriented / maintainability). | http://www.phpmetrics.org
	$(PHPMETRICS) --config=phpmetrics.json

.PHONY: qa.codesniffer
qa.codesniffer: _build ## FriendsOfPHP/PHP-CS-Fixer: The PHP Coding Standards Fixer (PHP CS Fixer) tool fixes your code to follow standards... | https://cs.symfony.com
	$(CODESNIFFER) fix --dry-run

.PHONY: qa.codesniffer.diff
qa.codesniffer.diff: _build ## PHP_CodeSniffer: Printing a diff report
	$(CODESNIFFER) fix --diff --dry-run

.PHONY: qa.codesniffer.fix
qa.codesniffer.fix: _build ## FriendsOfPHP/PHP-CS-Fixer: Fixing errors automatically
	$(CODESNIFFER) fix

.PHONY: qa.codesniffer.fix.files
qa.codesniffer.fix.files: _build ## FriendsOfPHP/PHP-CS-Fixer: Fixing errors automatically by specific files
	$(CODESNIFFER) fix --config .php-cs-fixer.dist.php $(COMMAND_ARGS)

.PHONY: qa.phpstan.analyze
qa.phpstan.analyze: _build ## phpstan/phpstan-symfony: Analyze code | https://phpstan.org
	$(PHPSTAN) analyze

.PHONY: qa.messdetector
qa.messdetector: _build ## PHP Mess Detector: Scan PHP source code and look for potential problems... | http://phpmd.org
	$(MESSDETECTOR) $(PROJECT_SRC) html phpmd.xml.dist --report-file $(PROJECT_BUILD)/phpmd.html

.PHONY: qa.infection
qa.infection: xdebug.on ## infection/infection: PHP Muta testing | https://infection.github.io/
	$(INFECTION) -j$(NPROCS)

.PHONY: qa.infection.withcoverage
qa.infection.withcoverage: xdebug.off ## infection/infection: PHP Muta testing | https://infection.github.io/
	$(INFECTION) -j$(NPROCS) --coverage=$(PROJECT_BUILD)/phpunit/coverage-xml
