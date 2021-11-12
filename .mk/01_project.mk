## PROJECT

.PHONY: start
start: docker.start ready ## Project: Start the current project.

.PHONY: start.one
start.one: docker.start.one ready ## Project: Stop all containers & start the current project.

.PHONY: stop
stop: docker.stop ## Project: Stop the current project.

.PHONY: sh
sh: ## Project: app sh access.
	$(EXEC_APP_ROOT) sh

##

.PHONY: check
check: install.dev composer.validate symfony.security.check db.validate tests ## Project: Launch of install / Composer, Security and DB validations / Tests

.PHONY: tests
tests: fixtures phpunit ## Project: Launch all tests.

.PHONY: coverage
coverage: phpunit.coverage phpunit.coverage.open ## Project: Generate & open all code coverage reports.

##

.PHONY: cc
cc: symfony.cc ## Project: Clear all caches.

.PHONY: clean
clean: ## Project: [PROMPT yN] Remove build, vendor & node_modules folders.
	@while [ -z "$$CONTINUE" ]; do \
		read -r -p "Remove build, vendor & node_modules folders? [yN] " CONTINUE; \
	done ; \
	if [ $$CONTINUE == "y" ]; \
	then \
		cd $(PROJECT_ROOT)/$(PROJECT_SRC); \
		rm -rf build vendor node_modules; \
		echo -e "\033[1;42mbuild, vendor & node_modules removed\033[0m"; \
	else \
		$(MAKE_S) cancelled; \
	fi; \

#
# INTERNAL
#

.PHONY: _build
_build: # Create 'build' folder.
	mkdir -p $(PROJECT_BUILD)

.PHONY: _build.clean
_build.clean: # Remove 'build' folder.
	rm -rf $(PROJECT_BUILD)

.PHONY: ready
ready: symfony.about
	@echo -e "\033[1;42mREADY!"
	@echo -e "  Website:    \e[4m$(URL_WEBSITE)\\033[24m"
	@echo -e "  API:        \e[4m$(URL_API)\\033[24m"
	@echo
	@#$(MAKE_S) env.app

.PHONY: cancelled
cancelled:
	echo -e "\033[1;41mAction cancelled.\033[0m"
	exit 1