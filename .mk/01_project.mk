## PROJECT

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
	@echo -e "\033[1;42m"
	@echo -e "READY!"
	@echo -e "  API:        \e[4m$(URL_API)\\033[24m"
	@echo -e "  Swagger:    \e[4m$(URL_SWAGGER)\\033[24m\033[42m"
	@echo -e "  Adminer:    \e[4m$(URL_ADMINER)\\033[24m\033[0m"
	@echo
	@$(MAKE_S) env.app