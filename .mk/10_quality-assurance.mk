## QUALITY ASSURANCE - STATIC ANALYZERS


.PHONY: qa.phpmetrics
qa.phpmetrics: _build ## PHPMetrics: Provide tons of metric (complexity / volume / object oriented / maintainability). | http://www.phpmetrics.org
	$(PHPMETRICS) --config=phpmetrics.json

.PHONY: qa.codesniffer
qa.codesniffer: ## FriendsOfPHP/PHP-CS-Fixer: The PHP Coding Standards Fixer (PHP CS Fixer) tool fixes your code to follow standards... | https://cs.symfony.com
	$(CODESNIFFER) fix --dry-run

.PHONY: qa.codesniffer.diff
qa.codesniffer.diff: ## PHP_CodeSniffer: Printing a diff report
	$(CODESNIFFER) fix --diff --dry-run

.PHONY: qa.codesniffer.fix
qa.codesniffer.fix: ## FriendsOfPHP/PHP-CS-Fixer: Fixing errors automatically
	$(CODESNIFFER) fix

.PHONY: qa.phpstan.analyze
qa.phpstan.analyze: ## phpstan/phpstan-symfony: Analyze code | https://phpstan.org
	$(PHPSTAN) analyze -c phpstan.neon

.PHONY: qa.messdetector
qa.messdetector: _build ## PHP Mess Detector: Scan PHP source code and look for potential problems... | http://phpmd.org
	$(MESSDETECTOR) $(PROJECT_SRC) html phpmd.xml --report-file build/phpmd.html


