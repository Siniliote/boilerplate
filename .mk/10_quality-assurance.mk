## QUALITY ASSURANCE - STATIC ANALYZERS

.PHONY: qa.codesniffer.fix
qa.codesniffer.fix: ## FriendsOfPHP/PHP-CS-Fixer: Fixing errors automatically
	$(CODESNIFFER) fix
